<?php

namespace app\modules\f2\components;

use app\modules\f2\helpers\Map;

/*
 * Класс работы с API КИС-WEB.
 * Прямой импорт ОСАГО.
 */
class Cis extends \app\common\components\Cis
{

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->username = \Yii::$app->params['s']['cis_privat_bank']['username'];
        $this->password = \Yii::$app->params['s']['cis_privat_bank']['password'];
        parent::__construct();
    
    }

    /**
     * Получает ID Бланка.
     *
     * @return mixed
     */
    public function idBlankGetter($series, $number)
    {

        $data = $this->cisRequest('/cis/utils/blanks_by_series_number', ['series' => $series, 'number' => $number]);

        if (isset($data[0]['id_blank'])) {
            return $data[0]['id_blank'];
        }
    }

    /**
     * Получает ID места регистрации
     *
     * @return mixed
     */
    public function idPlaceGetter($id_place_mtsbu)
    {

        $data = $this->cisRequest('/cis/utils/reg_place_by_id_mtsbu', ['id_place_mtsbu' => $id_place_mtsbu]);

        $id_place = null;

        if (isset($data[0]['id_place'])) {
            $id_place = $data[0]['id_place'];
        } else {

            /**
             * В случае, если метод КИС "cis/utils/reg_place_by_id_mtsbu"
             * не нашел ничего, заполняем $id_place "вручную", через Map::idPlace()
             */
            $id_place = Map::idPlace($id_place_mtsbu);

        }

        return $id_place;

    }

    /**
     * Отправляет договор в КИС
     *
     * @return mixed
     */
    public function contractSender($data)
    {

        $contract_data = json_decode($data['data_json'], true);

        $requestData = ['InsuranceKind' => ['ID' => '51'], //Константа
            'SalePoint' => ['ID' => '7122'], //Константа
            'Department' => ['ID' => '6158'], //Константа
            'InsurancePackage' => ['ID' => '45'], //Константа
            'InsuranceTariff' => ['ID' => '1746'], //Константа
            'OnDate' => date('d.m.Y', strtotime($contract_data['d_distr'])), //Дата оформления договора //d_distr
            'Calculator.InsuranceParam.Contract.BonusMalus' => Map::bonusMalus($contract_data['b_m']), //Бонус\Малус //b_m
            'Calculator.InsuranceParam.Contract.ContractNumberIsChanged' => 1, //Константа
            'Calculator.InsuranceParam.Contract.ContractNumber' => $data['contract_id'], //Внутренний номер договора внешней системы //contractId
            'Calculator.InsuranceParam.Contract.Blank' => ['DisplayName' => $data['sagr'] . ' ' . $data['nagr'], 'ID' => $data['id_blank']], //Серия и Номер полиса + ИД бланка в КИС
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Code' => $contract_data['numb_ins'], //ИНН //numb_ins
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.LastName' => $contract_data['f_name'], //Фамилия //f_name
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.FirstName' => $contract_data['s_name'], //Имя //s_name
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.MiddleName' => $contract_data['p_name'], //Отчество //p_name
            'Calculator.InsuranceParam.Contract.InureDate' => date('d.m.Y', strtotime($contract_data['d_beg'])), //Дата начала действия //d_beg
            'Calculator.InsuranceParam.Contract.EndDate' => date('d.m.Y', strtotime($contract_data['d_end'])), //Дата окончания действия //d_end
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Address.AddressString' => $contract_data['address_e'], //Адрес проживания //address_e
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentType' => ['ID' => Map::idDocType($contract_data['doc_name'])], //ИД берется из справочника типов документов
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.Date' => '26.07.2000', //Дата выдачи документа
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentLastName' => $contract_data['f_name'], //Фамилия
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentFirstName' => $contract_data['s_name'], //Имя
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentMiddleName' => $contract_data['p_name'], //Отчество
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.Series' => $contract_data['doc_series'], //Серия документа
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.Number' => $contract_data['doc_no'], //Номер документа
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.IssuedByUkr' => 'Славутичским МВГУ ВМС', //Кем выдан документ
            //'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneCountry' => '+380', //Константа
            //'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneNumber' => '994537772', //Номер телефона
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.Signer' => ['ID' => '106422'], //Константа
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.SignerAll' => '1', //Константа
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.IsContractCustomer' => '0', //Константа
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.AutoCategory' => ['ID' => Map::idAutoCategory($contract_data['c_type'])], //ИД берется из справочника Категорий ТС //FIXME: Проверить!!! хелпер Map::idAutoCategory() уже написан!!!
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.AutoModelString' => $contract_data['auto'], //Автомобиль строкой //auto
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.ManufactureYear' => $contract_data['prod_year'], //Год выпуска ТС //prod_year
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.VIN' => $contract_data['vin'], //ВИН код ТС  //vin
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.RegistrationPlace.Country' => ['ID' => '1'], //Константа
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.RegistrationPlace' => ['ID' => $data['id_place']], //ID города регистрации ТС в КИС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.StateNumber' => $contract_data['reg_no'], //Гос. номер ТС  //reg_no
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FranchiseCurrency' => $contract_data['franchise'], //Франшиза //franchise
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstInternalReinsuranceTariff' => Map::tvp($contract_data['franchise']), //ТВП,% FIXME: В пятницу 04.05.2018 Рома запустит
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Loading' => 30, //Нагрузка
            'Calculator.InsuranceParam.Contract.InsuranceParam0.BaseTariff' => 180, //Константа
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstTariff' => $contract_data['payment'], //Страховой платеж  //payment
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstPayment' => $contract_data['payment'], //Страховой платеж  //payment
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K1' => $contract_data['k1'], //k1
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K2' => $contract_data['k2'], //k2
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K3' => $contract_data['k3'], //k3
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K4' => $contract_data['k4'], //k4
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K5' => $contract_data['k5'], //k5
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K6' => $contract_data['k6'], //k6
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K7' => $contract_data['k7'], //k7
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K8' => Map::bonusMalus($contract_data['b_m']), //К(бонус-малус)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths1' => Map::isActive($contract_data['is_active1']), //is_active1
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths2' => Map::isActive($contract_data['is_active2']), //is_active2
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths3' => Map::isActive($contract_data['is_active3']), //is_active3
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths4' => Map::isActive($contract_data['is_active4']), //is_active4
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths5' => Map::isActive($contract_data['is_active5']), //is_active5
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths6' => Map::isActive($contract_data['is_active6']), //is_active6
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths7' => Map::isActive($contract_data['is_active7']), //is_active7
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths8' => Map::isActive($contract_data['is_active8']), //is_active8
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths9' => Map::isActive($contract_data['is_active9']), //is_active9
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths10' => Map::isActive($contract_data['is_active10']), //is_active10
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths11' => Map::isActive($contract_data['is_active11']), //is_active11
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths12' => Map::isActive($contract_data['is_active12']), //is_active12
        ];

        $data = $this->cisRequest('/cis/calc/form', $requestData, Cis::MODE_CONTRACT);

        return $data;

    }

}
