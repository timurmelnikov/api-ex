<?php

namespace app\modules\f4\controllers;

use app\modules\f4\components\Cis;
use yii\web\Controller;

/**
 * Default controller for the `f4` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        //$s = new Siesta();

        //$data = json_encode($s->contractGetter(20180601, 20180606));
        //$data = $s->contractGetter(20180601, 20180606);

        //$c = new Contract();
        //$data = $c->contractSender();

        /**
         * FIXME: Єтот массив нужен только для разработки
         */
        $a = [
            'Series' => [],
            'PolicyNo' => '21362',
            'IssueDate' => '06.06.2018',
            'PolicyType' => 'Simple',
            'TravelProgramm' => 'B',
            'DateFrom' => '24.06.2018',
            'Days' => '8',
            'DateTill' => '01.07.2018',
            'ValidityZone' => 'EU',
            'CountryISO' => 'GR',
            'TravelInsuredSum' => '30000',
            'TravelCurrency' => 'EUR',
            'AccidentInsuredSum' => '1000',
            'AccidentCurrency' => 'EUR',
            'RiskGroup' => 'T',
            'PaymentDate' => '07.05.2018',
            'Insurant' => 'LYTVYNENKO MAKSYM',
            'InsurantType' => 'ph.',
            'InsurantBirthDate' => '12.10.2015',
            'InsurantAddress' => [],
            'Beneficiary' => 'BY LOW',
            'BeneficiaryType' => [],
            'BeneficiaryBirthDate' => [],
            'BeneficiaryAddress' => [],
            'CurRate' => '31.15',
            'InsuredPersons' => [
                'InsuredPerson' => [[
                    'Name' => 'LYTVYNENKO MAKSYM',
                    'BirthDate' => '12.10.2015',
                    'PassportSerie' => 'FE',
                    'PassportNumber' => '140312',
                    'Address' => [],
                ], [
                    'Name' => 'LYTVYNENKO OLEKSANDRA',
                    'BirthDate' => '09.09.2009',
                    'PassportSerie' => 'ET',
                    'PassportNumber' => '401373',
                    'Address' => [],
                ], [
                    'Name' => 'LYTVYNENKO HANNA',
                    'BirthDate' => '18.07.1975',
                    'PassportSerie' => 'FK',
                    'PassportNumber' => '121682',
                    'Address' => [],
                ], [
                    'Name' => 'LYTVYNENKO LEONID',
                    'BirthDate' => '25.02.1975',
                    'PassportSerie' => 'ET',
                    'PassportNumber' => '401373',
                    'Address' => [],
                ],
                ],
            ],
            'PersonsNum' => '4',
            'TravelTariff' => '0.34',
            'AccidentTariff' => '0.01',
            'TravelPaymentSumBrutto' => '593.1',
            'AccidentPaymentSumBrutto' => '17.44',
            'TotalPaymentBrutto' => '610.54',
        ];

        $c = new Cis();
        $data = $c->requestDataFormatter($a);

        //$data = \app\modules\f4\helpers\Map::countryDestination('KZ');

        //$data = null;
        return $this->render('index', ['data' => $data]);
    }
}
