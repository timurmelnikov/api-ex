<?php

namespace app\modules\f3\components;

use app\common\helpers\Parser;

/*
 * Класс работы с API КИС-WEB.
 * Busfor.
 */
class Cis extends \app\common\components\Cis
{

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->username = \Yii::$app->params['s']['cis_busfor']['username'];
        $this->password = \Yii::$app->params['s']['cis_busfor']['password'];
        parent::__construct();

    }

    /**
     * Отправляет договор в КИС
     * FIXME: Метод в разработке!
     *
     * @return mixed
     */
    public function contractSender($data)
    {

        $contract_data = json_decode($data['data_json'], true);

        $requestData = [
            'SalePoint' => ['ID' => '14923'], // Точка продаж
            'InsurancePackage' => ['ID' => '349'], // Продукт
            'InsuranceTariff' => ['ID' => '1748'], // Тарифная сетка (тут будет другой ид!)
            'OnDate' => '26.04.2018', // Дата заключения договора
            'Department' => ['ID' => '6165'], // Подразделение
            // -------------------------------------------------------------------------------------------------------------------------------------- Договор
            'Calculator.InsuranceParam.Contract.ContractNumber' => 'DNH0NBR-16BT09K', // Номер билета (id)
            'Calculator.InsuranceParam.Contract.ContractNumberIsChanged' => '1', // Признак, что NUM_DOC отличается от REG_NUM (не трогать)
            'Calculator.InsuranceParam.Contract.InureDate' => '27.04.2018', // Дата начала действия договора (insurance_paid_at)
            'Calculator.InsuranceParam.Contract.EndDate' => '26.04.2019', // Дата окончания действия договора (trip_start_at + 24 часа)
            'Calculator.InsuranceParam.Contract.InureType' => ['ID' => '4'], // Тип вступления. 4 - с полного (всегда).
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.Signer' => ['ID' => '106422'], // Подписант (Артюхов)
            // --------------------------------------------------------------------------------------------------------------------------------------
            // -------------------------------------------------------------------------------------------------------------------------------------- Страхователь
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.LastName' => Parser::fio($passenger_name, Parser::FIO_FIRST_NAME),//'Statham', // Фамилия страхователя (passenger_nameр)
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.FirstName' => Parser::fio($passenger_name, Parser::FIO_LAST_NAME),//'Jason', // Имя страхователя (passenger_name)
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.MiddleName' => Parser::fio($passenger_name, Parser::FIO_PATRONIMIC_NAME),//'Yurievich', // Отчество страхователя (passenger_name)
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneCountry' => '+380', // Телефонный код страны
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneNumber' => '501111111', // Телефонный номер страхователя (passenger_phone)
            // --------------------------------------------------------------------------------------------------------------------------------------
            // -------------------------------------------------------------------------------------------------------------------------------------- Параметры объекта страхования
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstAmount' => '150', // Страховая сумма (ticket_price)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstPayment' => '30', // Страховой платеж (insurance_price)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.TicketNumber' => '1', // Номер билета (ticket_number)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.TrainNumber' => '12', // Номер рейса (trip_number)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.DispatchPlace' => 'Киев', // Место отправления (trip_from_city)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.ArrivalPlace' => 'Харьков', // Место прибытия (trip_to_city)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.DateStartTravel' => '27.04.2018 09:15', // Время и дата отправки (trip_start_at)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.DateInureDoc' => '27.04.2018 09:15', // Время и дата начала действия договора = trip_start_at
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.DateEndDoc' => '27.04.2018 12:15', // Время и дата прекращения действия договора = trip_start_at + 3 часа.
            // --------------------------------------------------------------------------------------------------------------------------------------

        ];

        $data = $this->cisRequest('cis/calc/form', $requestData, Cis::MODE_CONTRACT);

        return $data;

    }

}
