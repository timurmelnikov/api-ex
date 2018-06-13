<?php

namespace app\modules\f4\controllers;

use app\modules\f4\components\Cis;
use app\modules\f4\models\Contract;
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

        $c = new Contract();
        $data = $c->contractSender();



        //$a=json_decode('{"Series":[],"PolicyNo":"21864","IssueDate":"08.06.2018","PolicyType":"Simple","TravelProgramm":"B","DateFrom":"24.07.2018","Days":"10","DateTill":"02.08.2018","ValidityZone":"WW-1","CountryISO":"MV","TravelInsuredSum":"30000","TravelCurrency":"USD","AccidentInsuredSum":"10000","AccidentCurrency":"USD","RiskGroup":"T","PaymentDate":"08.06.2018","Insurant":"KUZMYNCHUK LILIIA","InsurantType":"ph.","InsurantBirthDate":"08.03.1990","InsurantAddress":[],"Beneficiary":"BY LOW","BeneficiaryType":[],"BeneficiaryBirthDate":[],"BeneficiaryAddress":[],"CurRate":"26.7","InsuredPersons":{"InsuredPerson":[{"Name":"KUZMYNCHUK LILIIA","BirthDate":"08.03.1990","PassportSerie":"FL","PassportNumber":"187081","Address":[]},{"Name":"KRAVCHUK TARAS","BirthDate":"15.11.1981","PassportSerie":"FL","PassportNumber":"186988","Address":[]}]},"PersonsNum":"2","TravelTariff":"0.55","AccidentTariff":"0.06","TravelPaymentSumBrutto":"293.7","AccidentPaymentSumBrutto":"32.04","TotalPaymentBrutto":"325.74"}', true);


        //$c = new Cis();
        //$data = json_encode($c->requestDataFormatter($a), true);
        //$data = $c->contractSender($a);

        //$data = \app\modules\f4\helpers\Map::countryDestination('KZ');

        //$data = null;
        return $this->render('index', ['data' => $data]);
    }
}
