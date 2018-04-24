<?php

namespace app\modules\f2\components;

/*
 * Класс работы с API КИС-WEB.
 * Прямой импорт ОСАГО.
 */
class Cis extends \app\common\components\Cis
{

    /**
     * Получает ID Бланка.
     *
     * @return mixed
     */
    public function idBlankGetter($series, $number)
    {

        $data = $this->cisRequest('cis/utils/blanks_by_series_number', ['series' => $series, 'number' => $number]);

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

        $data = $this->cisRequest('cis/utils/reg_place_by_id_mtsbu', ['id_place_mtsbu' => $id_place_mtsbu]);

        $id_place = null;

        if (isset($data[0]['id_place'])) {
            $id_place = $data[0]['id_place'];
        } else {

            /**
             * В случае, если метод КИС "cis/utils/reg_place_by_id_mtsbu"
             * не нашел ничего, заполняем $id_place "вручную"
             * TODO: Стоит подумать про отдельный метод для этого
             */
            if ($id_place_mtsbu == 3345) {
                $id_place = 41949; //ТЗ зареестровані в iнших краiнах
            }
            if ($id_place_mtsbu == 3603) {
                $id_place = 33681; //Гадяч
            }

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

        $requestData = ['InsuranceKind' => ['ID' => '51'], //Константа
            'SalePoint' => ['ID' => '7122'], //Константа
            'Department' => ['ID' => '6158'], //Константа
            'InsurancePackage' => ['ID' => '45'], //Константа
            'InsuranceTariff' => ['ID' => '1746'], //Константа
            'OnDate' => '24.04.2018', //Дата оформления договора
            'Calculator.InsuranceParam.Contract.BonusMalus' => 0.9, //Бонус\Малус
            'Calculator.InsuranceParam.Contract.ContractNumberIsChanged' => 1, //Константа
            'Calculator.InsuranceParam.Contract.ContractNumber' => '59c3a86a376e2e52ca746caf', //Внутренний номер договора внешней системы
            'Calculator.InsuranceParam.Contract.Blank' => ['DisplayName' => 'АК 8934422', 'ID' => '8725989'], //Серия и Номер полиса + ИД бланка в КИС
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Code' => '2628217532', //ИНН
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.LastName' => 'Позняк', //Фамилия
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.FirstName' => 'Роман', //Имя
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.MiddleName' => 'Владиславович', //Отчество
            'Calculator.InsuranceParam.Contract.InureDate' => '25.04.2018', //Дата начала действия
            'Calculator.InsuranceParam.Contract.EndDate' => '24.04.2019', //Дата окончания действия
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Address.AddressString' => 'Киев, Регенараторная,4 кв. 7-163', //Адрес проживания
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentType' => ['ID' => '14'], //ИД берется из справочника типов документов
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.Date' => '26.07.2000', //Дата выдачи документа
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentLastName' => 'Позняк',
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentFirstName' => 'Роман',
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentMiddleName' => 'Владиславович',
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.Series' => 'СМ', //Серия документа
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.Number' => '565495', //Номер документа
            'Calculator.InsuranceParam.Contract.PrivilegeDocument.IssuedByUkr' => 'Славутичским МВГУ ВМС', //Кем выдан документ
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneCountry' => '+380', //Константа
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneNumber' => '994537772', //Номер телефона
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.Signer' => ['ID' => '96221'], //Константа
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.SignerAll' => '1', //Константа
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.IsContractCustomer' => '0', //Константа
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.AutoCategory' => ['ID' => '4'], //ИД берется из справочника Категорий ТС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.AutoModelString' => 'Самая Мощная тачка',
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.ManufactureYear' => 2014, //Год выпуска ТС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.VIN' => 'LB37624S3DL029247', //ВИН код ТС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.RegistrationPlace.Country' => ['ID' => '1'], //Константа
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.RegistrationPlace' => ['ID' => '41892'], //ID города регистрации ТС в КИС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.StateNumber' => 'АА1234ВВ', //Гос. номер ТС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FranchiseCurrency' => '1000', //Франшиза
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Loading' => 25, //Нагрузка
            'Calculator.InsuranceParam.Contract.InsuranceParam0.BaseTariff' => 180, //Константа
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstTariff' => 311.04, //Страховой платеж
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FirstPayment' => 311.04, //Страховой платеж
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K1' => 1, //k1
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K2' => 1.44, //k2
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K3' => 1, //k3
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K4' => 1.5, //k4
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K5' => 1, //k5
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K6' => 1, //k6
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K7' => 1, //k7
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K8' => 0.8, //К(бонус-малус)
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths1' => false, //is_active1
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths2' => false, //is_active2
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths3' => false, //is_active3
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths4' => false, //is_active4
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths5' => false, //is_active5
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths6' => false, //is_active6
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths7' => false, //is_active7
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths8' => false, //is_active8
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths9' => false, //is_active9
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths10' => false, //is_active10
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths11' => false, //is_active11
            'Calculator.InsuranceParam.Contract.InsuranceParam0.AutoUsageMonths12' => false, //is_active12
        ];

        $data = $this->cisRequest('cis/calc/form', $requestData, Cis::MODE_CONTRACT);

    }

}
