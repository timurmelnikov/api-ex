<?php

namespace app\modules\f2\components;

use app\common\helpers\Map;

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



        $contract_data = json_decode($data['data_json'], true);


        //$contract_data['XXX']




        $requestData = ['InsuranceKind' => ['ID' => '51'], //Константа
            'SalePoint' => ['ID' => '7122'], //Константа
            'Department' => ['ID' => '6158'], //Константа
            'InsurancePackage' => ['ID' => '45'], //Константа
            'InsuranceTariff' => ['ID' => '1746'], //Константа
            'OnDate' => '24.04.2018', //Дата оформления договора //d_distr
            'Calculator.InsuranceParam.Contract.BonusMalus' => Map::bonusMalus1($contract_data['b_m']), //Бонус\Малус //b_m
            'Calculator.InsuranceParam.Contract.ContractNumberIsChanged' => 1, //Константа
            'Calculator.InsuranceParam.Contract.ContractNumber' => $data['contract_id'], //Внутренний номер договора внешней системы //contractId
            'Calculator.InsuranceParam.Contract.Blank' => ['DisplayName' => $data['sagr'].' '.$data['nagr'], 'ID' => $data['id_blank']], //Серия и Номер полиса + ИД бланка в КИС
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Code' => $contract_data['numb_ins'], //ИНН //numb_ins
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.LastName' => $contract_data['f_name'], //Фамилия //f_name
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.FirstName' => $contract_data['s_name'], //Имя //s_name
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.MiddleName' => $contract_data['p_name'], //Отчество //p_name
            'Calculator.InsuranceParam.Contract.InureDate' => '25.04.2018', //Дата начала действия //d_beg
            'Calculator.InsuranceParam.Contract.EndDate' => '24.04.2019', //Дата окончания действия //d_end
            'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.Address.AddressString' => $contract_data['address_e'], //Адрес проживания //address_e
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentType' => ['ID' => '14'], //ИД берется из справочника типов документов
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.Date' => '26.07.2000', //Дата выдачи документа
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentLastName' => 'Позняк',
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentFirstName' => 'Роман',
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.DocumentMiddleName' => 'Владиславович',
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.Series' => 'СМ', //Серия документа
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.Number' => '565495', //Номер документа
            //'Calculator.InsuranceParam.Contract.PrivilegeDocument.IssuedByUkr' => 'Славутичским МВГУ ВМС', //Кем выдан документ
            //'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneCountry' => '+380', //Константа
            //'Calculator.InsuranceParam.Contract.ContractCustomer.Customer.ContactTelephone.PhoneNumber' => '994537772', //Номер телефона
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.Signer' => ['ID' => '96221'], //Константа
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.SignerAll' => '1', //Константа
            'Calculator.InsuranceParam.Contract.ContractCustomerNative.IsContractCustomer' => '0', //Константа
            //'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.AutoCategory' => ['ID' => '4'], //ИД берется из справочника Категорий ТС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.AutoModelString' => $contract_data['auto'], //Автомобиль строкой //auto
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.ManufactureYear' => $contract_data['prod_year'], //Год выпуска ТС //prod_year
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.VIN' => $contract_data['vin'], //ВИН код ТС  //vin
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.RegistrationPlace.Country' => ['ID' => '1'], //Константа
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.RegistrationPlace' => ['ID' => $data['id_place']], //ID города регистрации ТС в КИС
            'Calculator.InsuranceParam.Contract.InsuranceParam0.InsuranceObject.CurrentAutoCertificate.StateNumber' => $contract_data['reg_no'], //Гос. номер ТС  //reg_no
            'Calculator.InsuranceParam.Contract.InsuranceParam0.FranchiseCurrency' => $contract_data['franchise'], //Франшиза //franchise
            'Calculator.InsuranceParam.Contract.InsuranceParam0.Loading' => 25, //Нагрузка
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
            'Calculator.InsuranceParam.Contract.InsuranceParam0.K8' => Map::bonusMalus1($contract_data['b_m']), //К(бонус-малус)
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

        return $data;

    }

}
