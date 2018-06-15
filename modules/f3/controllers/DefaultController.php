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

 

        //Удаление договоров в КИС
        //$contract = new Contract();
        //$data = $contract->contractRemover();

        //$cis = new Cis();
        //$data = $cis->contractRemove('busforua-49268841-1');


        $data = null;
        return $this->render('index', ['data' => $data]);

        //return $this->render('index');
    }
}
