<?php

namespace app\modules\f4\components;

use app\modules\f4\helpers\Map;
use app\modules\f4\helpers\Parse;

/*
 * Класс работы с API КИС-WEB.
 */
class Cis extends \app\common\components\Cis
{

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->username = \Yii::$app->params['s']['cis_siesta_admin']['username'];
        $this->password = \Yii::$app->params['s']['cis_siesta_admin']['password'];
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

        $requestData = $this->requestDataFormatter($contract_data);

        $data = $this->cisRequest('/cis/calc/form', $requestData, Cis::MODE_CONTRACT);

        return $data;

    }

    /**
     * Форматирование данных для запроса FIXME: метод будет приватным
     *
     * @param array $data
     * @return array
     */
    public function requestDataFormatter($contract_data)
    {
        $requestData = [
            'InsuranceKind.ID' => 72, //  Константа   //
            'InsurancePackage.ID' => 332, //  Константа   //
            'InsuranceTariff.ID' => 1781, //  Константа   //
            'OnDate' => Parse::dateCis($contract_data['IssueDate']), //  <IssueDate> //
            'SalePoint' => ['ID' => '14939'], //  Константа   //
            'Department' => ['ID' => '5895'], //  Константа   //
            'Calculator.NotCalculated' => true, //  Константа   //
            'Calculator.InsuranceParam.Contract.RegistrationDepartment' => ['ID' => '5895'], //    Константа    //
            'Calculator.InsuranceParam.Contract.ContractNumberIsChanged' => 1, //    Константа   //
            'Calculator.InsuranceParam.Contract.ContractNumber' => $contract_data['PolicyNo'], //  <PolicyNo>  //
            'Calculator.InsuranceParam.Contract.InureDate' => Parse::dateCis($contract_data['DateFrom']), //  <DateFrom>  //
            'Calculator.InsuranceParam.Contract.EndDate' => Parse::dateCis($contract_data['DateTill']), //  <DateTill>  //
            //    'Calculator.InsuranceParam.Contract.RateOfExchange'=>25.000,
            'Calculator.InsuranceParam.Contract.RateOfExchangeEuro' => 10.000,
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.Signer' => ['ID' => $contract_data['PolicyNo']], //  <PolicyNo>  //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Programs.ID' => 2, //   Константа  //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.IsMultivisa' => 0, //   Константа  //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.DateAbroad' => Parse::dateCis($contract_data['DateFrom']), //   <DateFrom> //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.DateReturn' => Parse::dateCis($contract_data['DateTill']), //   <DateTill> //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PeriodAbroad' => $contract_data['Days'], //   <Days>     //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PeriodAbroadFact' => $contract_data['Days'], //   <Days>     //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PeriodDocument' => $contract_data['Days'], //   <Days>     //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.TravelingSpecialCondition.ID' => 4, // Константа. Цель = Туризм //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.CoveringTerritory.ID' => Map::coveringTerritory($contract_data['ValidityZone']), // Если ValidityZone = EU, передаём ид = 7. Если ValidityZone = WW-1 или Пусто, передаём ид = 8//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.CountryDestination' => Map::countryDestination($contract_data['CountryISO']), // Страна поездки, <CountryISO> //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Loading' => 15, //   Константа  //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.MedicalCosts.Amount.OriginalValue' => $contract_data['TravelInsuredSum'], // <TravelInsuredSum> //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Accident.Amount.OriginalValue' => $contract_data['AccidentInsuredSum'], // <AccidentInsuredSum> //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InabilityTrip.Amount.OriginalValue' => '0', // Константа //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstInternalReinsuranceTariff' => 41.5, // Константа //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Baggage.Payment.Value' => 0, // Константа //
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InabilityTrip.Payment.Value' => 0, // Константа //
            // Страхователь //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.IsResident' => 1, // Константа //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Country' => 1, // Константа //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Code' => '0000000000', // Константа //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.LastName' => Parse::fio($contract_data['Insurant'])[0], // <Insurant> //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.FirstName' => Parse::fio($contract_data['Insurant'])[1], // <Insurant> //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.MiddleName' => '', // Константа //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.DateBegin' => Parse::dateCis($contract_data['InsurantBirthDate']), // <InsurantBirthDate> //
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Address.AddressStringEng' => 'Ukraine', // Константа //
            // Документ Страхователя //
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.DocumentType.ID' => 24, // Константа //
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.DocumentLastName' => Parse::fio($contract_data['Insurant'])[0], // <Insurant> //
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.DocumentFirstName' => Parse::fio($contract_data['Insurant'])[1], // <Insurant> //
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Date' => '01.01.2000', // Константа //
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Series' => $contract_data['InsuredPersons']['InsuredPerson'][0]['PassportSerie'], // InsuredPerson.<PassportSerie> //
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Number' => $contract_data['InsuredPersons']['InsuredPerson'][0]['PassportNumber'], // InsuredPerson.<PassportNumber> //
            'Calculator.InsuranceParam.Contract.InsuranceParamsCount' => $contract_data['PersonsNum'], // <PersonsNum> //
        ];

        $index = 0;
        foreach ($contract_data['InsuredPersons']['InsuredPerson'] as $item) {
            $a = $item;
            $requestData = array_merge($requestData, [
                //N-й Застрахованный объект//
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.Code' => '0000000000', // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.LastName' => Parse::fio($item['Name'])[0], // InsuredPerson.<Name> // 
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.FirstName' =>  Parse::fio($item['Name'])[1], // InsuredPerson.<Name> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.MiddleName' => '', // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.DateBegin' => Parse::dateCis($item['BirthDate']), // InsuredPerson.<BirthDate> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.Address.AddressStringEng' => 'Ukraine', // Константа //
                // Документ N-го Застрахованного объекта //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.PersonDocument.DocumentType.ID' => 24, // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.PersonDocument.DocumentLastName' => Parse::fio($item['Name'])[0], // InsuredPerson.<Name> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.PersonDocument.DocumentFirstName' => Parse::fio($item['Name'])[1], // InsuredPerson.<Name> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.PersonDocument.Date' => '01.01.2000', // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.PersonDocument.Series' => $item['PassportSerie'], // InsuredPerson.<PassportSerie> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.PersonDocument.Number' => $item['PassportNumber'], // InsuredPerson.<PassportNumber> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.MedicalCosts.IsInsured' => true, // Признак страхования МедЗатрат. Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.Accident.IsInsured' => true, // Признак страхования НС. Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.MedicalCosts.Payment.Value' =>$contract_data['TravelPaymentSumBrutto'], //84.73, // InsuredPerson.<TravelPaymentSumBrutto> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.Accident.Payment.Value' => $contract_data['AccidentPaymentSumBrutto'],//2.49, // InsuredPerson.<AccidentPaymentSumBrutto> //
            ]);

            $index++;
        }
        return $requestData;
    }

}
