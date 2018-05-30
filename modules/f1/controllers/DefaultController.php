<?php

namespace app\modules\f1\controllers;

use yii\web\Controller;
use app\modules\f1\components\PB;

/**
 * Default controller for the `f1` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {


        //$data = \Yii::getAlias('@app') . '/config/sequrity/pb_1_certificates/key.pem';

        $pb = new PB;

        $data = $pb->contractGetter('2018-05-29', 'RT');
        return $this->render('index', ['data'=> $data]);
    }
}
