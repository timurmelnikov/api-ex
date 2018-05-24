<?php

namespace app\modules\f3\controllers;

use app\modules\f3\components\Cis;
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

        //Получение договоров в таблицу CONTRACTS
        //$contract = new Contract();
        //$data = $contract->contractGetter();



        //Отправка договоров в КИС
        //$contract = new Contract();
        //$data = $contract->contractSender();




        //$cis = new Cis();
        //$data = $cis->contractSearchByNumber('АК 9064863');

        //$data = Parse::fio('Мельников11111111111111119123456789   Тимур  Викторович')[1];
        //$data = Parse::inn('2741708592');

        //Вставка договора в КИС
        //$contract = new Contract();
        //$data = $contract->contractSender();

        $data = null;
        return $this->render('index', ['data' => $data]);

        //return $this->render('index');
    }
}
