<?php

namespace app\modules\f4\components;

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

        $requestData = $this->requestDataFormatter($data);

        $data = $this->cisRequest('/cis/calc/form', $requestData, Cis::MODE_CONTRACT);

        return $data;

    }

    /**
     * Форматирование данных для запроса
     *
     * @param array $data
     * @return array
     */
    public function requestDataFormatter($data)
    {

        $requestData = [
            'InsuranceKind.ID' => 72,
            'InsurancePackage.ID' => 332,
            'InsuranceTariff.ID' => 1723,
            'OnDate' => '10.05.2018', //<IssueDate>//
            'SalePoint' => ['ID' => '14939'],
            'Department' => ['ID' => '5895'],
            //-----------------------Договор страхования//

            'Calculator.InsuranceParam.Contract.ContractNumberIsChanged' => 1, //Признак, чтоNUM_DOCотличаетсяотREG_NUM(не трогать)//
            'Calculator.InsuranceParam.Contract.ContractNumber' => 10, //PolicyNo//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Action' => ['ID' => '364'], //ID акции. Константа//
            'Calculator.InsuranceParam.Contract.InureDate' => '14.06.2018', //<DateFrom>//
            'Calculator.InsuranceParam.Contract.EndDate' => '21.06.2018', //<DateTill>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Programs.ID' => 2, //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.IsMultivisa' => 0, //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.DateAbroad' => '14.06.2018', //<DateFrom>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.DateReturn' => '21.06.2018', //<DateTill>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PeriodAbroad' => 8, //Days//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PeriodAbroadFact' => 8, //Days//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PeriodDocument' => 8, //Days//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.TravelingSpecialCondition.ID' => 4, //Константа. Цель = Туризм//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.CoveringTerritory.ID' => 7, //Если ValidityZone = EU, передаём ид = 7. Если ValidityZone = WW-1 или Пусто, передаём ид = 8//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.CountryDestination' => 112, //Страна поездки, <Country>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.MedicalCosts.Amount.OriginalValue' => '30000', //TravelInsuredSum//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Accident.Amount.OriginalValue' => '1000', //<AccidentInsuredSum>1//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InabilityTrip.Amount.OriginalValue' => '0', //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParamsCount' => 2, //<PersonsNum>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Loading' => 15, //Константа//
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.IsResident' => 1, //Константа//
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Country' => 1, //Константа//
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.LastName' => 'YARRMA', //<Insurant>//
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.FirstName' => 'ADEL', //<Insurant>//
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.DateBegin' => '24.04.1984', //<InsurantBirthDate>//
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Code' => '0000000000', // Константа//
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Address.AddressStringEng' => 'Ukraine', // Адрес страхователя

            // -------------------------------------------------------------------------------------------------------------------------------------- Документы страхователя
            //    'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.DocumentType'=>['ID'=>'11'],                     // Тип документа страхователя
            //    'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Series'=>'ВА',                                 // Серия документа страхователя
            //    'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Number'=>'387926',                             // Номер документа страхователя
            //    'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Date'=>'30.07.1997',                             // Дата выдачи документа страхователя
            //    'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.IssuedByUkr'=>    'БЕРДИЧЕВСКИМ ГРО УМВД',         // Кем выдан документа страхователя
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.DocumentType.ID' => 24, //Константа//
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.DocumentLastName' => 'YARMAK', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.DocumentFirstName' => 'ADEL', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Series' => 'FE', //InsuredPerson.<PassportSerie>//
            'Calculator.InsuranceParam.Contract.ContractCustomer.CustomerDocument.Number' => '052918', //InsuredPerson.<PassportNumber>//
            // --------------------------------------------------------------------------------------------------------------------------------------

            'Calculator.InsuranceParam.Contract.RateOfExchangeEuro' => 31.74,
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstInternalReinsuranceTariff' => 41.5, //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.MedicalCosts.Payment.Value' => 172.66, //<TravelPaymentSumBrutto>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Accident.Payment.Value' => 5.08, //<AccidentPaymentSumBrutto>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Baggage.Payment.Value' => 0, //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InabilityTrip.Payment.Value' => 0, //Константа//
            'Calculator.InsuranceParam.Contract.ForceInsurancePayment' => 177.74, //<TotalPaymentBrutto>//
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.Signer' => ['ID' => '106422'], //Константа//

        ];

        //Тут, в цикле будет собираться блок застрахованных

        $requestData = array_merge($requestData,  [
            //1-йЗастрахованныйобъект//

            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.IsContractCustomer' => 0, //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.Person.LastName' => 'YARMAK', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.Person.FirstName' => 'ADEL', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.Person.DateBegin' => '08.04.1984', //InsuredPerson.<InsurantBirthDate>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.Person.Address.AddressStringEng' => 'Ukraine', //Адрес застрахованного
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PersonDocument.DocumentType.ID' => 24, //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PersonDocument.DocumentLastName' => 'YARMAK', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PersonDocument.DocumentFirstName' => 'ADEL', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PersonDocument.Series' => 'FE', //InsuredPerson.<PassportSerie>//
            'Calculator.InsuranceParam.Contract.InsuranceParam0.PersonDocument.Number' => '052918', //InsuredPerson.<PassportNumber>//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.InsuranceObject.IsContractCustomer' => 0, //Константа//

            //2-йЗастрахованныйобъект. При условии, если <PersonsNum> > 1, необходимо добавлять блоки для каждого дополнительного Застрахованного//

            'Calculator.InsuranceParam.Contract.InsuranceParam1.InsuranceObject.Person.LastName' => 'KOLOTOV', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.InsuranceObject.Person.FirstName' => 'VLADYSLAV', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.InsuranceObject.Person.DateBegin' => '16.06.1963', //InsuredPerson.<InsurantBirthDate>//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.InsuranceObject.Person.Address.AddressStringEng' => 'Ukraine', // Адрес застрахованного
            'Calculator.InsuranceParam.Contract.InsuranceParam1.PersonDocument.DocumentType.ID' => 24, //Константа//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.PersonDocument.DocumentLastName' => 'KOLOTOV', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.PersonDocument.DocumentFirstName' => 'VLADYSLAV', //InsuredPerson.<Name>//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.PersonDocument.Series' => 'FC', //InsuredPerson.<PassportSerie>//
            'Calculator.InsuranceParam.Contract.InsuranceParam1.PersonDocument.Number' => '874934', //InsuredPerson.<PassportNumber>//

        ]);

        return $requestData;
    }

}
