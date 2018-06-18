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
     * Префикс номера договора (для уникальности поиска в КИС)
     */
    const NUM_PREFIX = 'siesta-';

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

        $contract_data = $this->requestDataFormatter(json_decode($data['data_json'], true));

        //$requestData = json_encode($data);

        $data = $this->cisRequest('/cis/calc/form', $contract_data, Cis::MODE_CONTRACT);

        return $data;

    }

    /**
     * Форматирование данных для запроса
     *
     * @param array $data
     * @return array
     */
    private function requestDataFormatter($contract_data)
    {
        $data = [
            'InsuranceKind.ID' => 72, //  Константа   //
            'InsurancePackage.ID' => 332, //  Константа   //
            'InsuranceTariff.ID' => 1781, //  Константа   //
            'OnDate' => Parse::dateCis($contract_data['IssueDate']), //  <IssueDate> //
            'SalePoint' => ['ID' => '14939'], //  Константа   //
            'Department' => ['ID' => '5895'], //  Константа   //
            'Calculator.NotCalculated' => true, //  Константа   //
            'Calculator.InsuranceParam.Contract.RegistrationDepartment' => ['ID' => '5895'], //    Константа    //
            'Calculator.InsuranceParam.Contract.ContractNumberIsChanged' => 1, //    Константа   //
            'Calculator.InsuranceParam.Contract.ContractNumber' => self::NUM_PREFIX . $contract_data['PolicyNo'], //  <PolicyNo>  //
            'Calculator.InsuranceParam.Contract.InureDate' => Parse::dateCis($contract_data['DateFrom']), //  <DateFrom>  //
            'Calculator.InsuranceParam.Contract.EndDate' => Parse::dateCis($contract_data['DateTill']), //  <DateTill>  //
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.Signer' => ['ID' => '106422'], //  <PolicyNo>  //
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

            'Calculator.InsuranceParam.Contract.InsuranceParamsCount' => $contract_data['PersonsNum'], // <PersonsNum> //
        ];

        if ($contract_data['PersonsNum'] == 1) {

            $data = array_merge($data, [
                'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Series' => $contract_data['InsuredPersons']['InsuredPerson']['PassportSerie'], // InsuredPerson.<PassportSerie> //
                'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Number' => $contract_data['InsuredPersons']['InsuredPerson']['PassportNumber'],
            ]); // InsuredPerson.<PassportNumber> //

            $data = array_merge($data, [

                //1-й Застрахованный объект//
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.InsuranceObject.Person.Code' => '0000000000', // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.InsuranceObject.Person.LastName' => Parse::fio($contract_data['InsuredPersons']['InsuredPerson']['Name'])[0], // InsuredPerson.<Name> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.InsuranceObject.Person.FirstName' => Parse::fio($contract_data['InsuredPersons']['InsuredPerson']['Name'])[1], // InsuredPerson.<Name> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.InsuranceObject.Person.MiddleName' => '', // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.InsuranceObject.Person.DateBegin' => Parse::dateCis($contract_data['InsuredPersons']['InsuredPerson']['BirthDate']), // InsuredPerson.<BirthDate> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.InsuranceObject.Person.Address.AddressStringEng' => 'Ukraine', // Константа //
                // Документ 1-го Застрахованного объекта //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.PersonDocument.DocumentType.ID' => 24, // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.PersonDocument.DocumentLastName' => Parse::fio($contract_data['InsuredPersons']['InsuredPerson']['Name'])[0], // InsuredPerson.<Name> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.PersonDocument.DocumentFirstName' => Parse::fio($contract_data['InsuredPersons']['InsuredPerson']['Name'])[1], // InsuredPerson.<Name> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.PersonDocument.Date' => '01.01.2000', // Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.PersonDocument.Series' => $contract_data['InsuredPersons']['InsuredPerson']['PassportSerie'], // InsuredPerson.<PassportSerie> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.PersonDocument.Number' => $contract_data['InsuredPersons']['InsuredPerson']['PassportNumber'], // InsuredPerson.<PassportNumber> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.MedicalCosts.IsInsured' => true, // Признак страхования МедЗатрат. Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.Accident.IsInsured' => true, // Признак страхования НС. Константа //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.MedicalCosts.Payment.Value' => (double) $contract_data['InsuredPersons']['InsuredPerson']['TravelPaymentSumBrutto'], //84.73, // InsuredPerson.<TravelPaymentSumBrutto> //
                'Calculator.InsuranceParam.Contract.InsuranceParam' . '0' . '.Accident.Payment.Value' => (double) $contract_data['InsuredPersons']['InsuredPerson']['AccidentPaymentSumBrutto'], //2.49, // InsuredPerson.<AccidentPaymentSumBrutto> //

            ]);
        } else {

            $data = array_merge($data, [
                'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Series' => $contract_data['InsuredPersons']['InsuredPerson'][0]['PassportSerie'], // InsuredPerson.<PassportSerie> //
                'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Number' => $contract_data['InsuredPersons']['InsuredPerson'][0]['PassportNumber'],
            ]); // InsuredPerson.<PassportNumber> //

            $index = 0;
            foreach ($contract_data['InsuredPersons']['InsuredPerson'] as $item) {
                $a = $item;
                $data = array_merge($data, [
                    //N-й Застрахованный объект//
                    'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.Code' => '0000000000', // Константа //
                    'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.LastName' => Parse::fio($item['Name'])[0], // InsuredPerson.<Name> //
                    'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.InsuranceObject.Person.FirstName' => Parse::fio($item['Name'])[1], // InsuredPerson.<Name> //
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
                    'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.MedicalCosts.Payment.Value' => (double) $item['TravelPaymentSumBrutto'], //84.73, // InsuredPerson.<TravelPaymentSumBrutto> //
                    'Calculator.InsuranceParam.Contract.InsuranceParam' . $index . '.Accident.Payment.Value' => (double) $item['AccidentPaymentSumBrutto'], //2.49, // InsuredPerson.<AccidentPaymentSumBrutto> //
                ]);

                $index++;
            }

        }

        if ($contract_data['AccidentCurrency'] == 'EUR') {
            $data = array_merge($data, ['Calculator.InsuranceParam.Contract.RateOfExchangeEuro' => (double) $contract_data['CurRate']]);
        }

        if ($contract_data['AccidentCurrency'] == 'USD') {
            $data = array_merge($data, ['Calculator.InsuranceParam.Contract.RateOfExchange' => (double) $contract_data['CurRate']]);
        }

        return $data;
    }

}
