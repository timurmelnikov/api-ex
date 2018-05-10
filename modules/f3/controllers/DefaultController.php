<?php

namespace app\modules\f3\controllers;

use app\modules\f3\components\Busfor;
use app\modules\f3\models\Contract;
use yii\web\Controller;

/**
 * Default controller for the `f3` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        //Просто вызов Busfor
        //$busfor = new Busfor();
        //$data = $busfor->contractGetter('2018-04-28', '2018-04-29');


        $contract = new Contract();
        $data = $contract->contractGetter();



        //Вставка договора в КИС
        //$contract = new Contract();
        //$data = $contract->contractSender();

        //$data = null;
        return $this->render('index', ['data' => $data]);

        //return $this->render('index');
    }
}
