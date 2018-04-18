<?php

namespace app\modules\f2\controllers;

use yii\web\Controller;
use app\modules\f2\components\PB;

/**
 * Default controller for the `f2` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $pb = new PB();
      

        $data = $pb->contractGetter();



        return $this->render('index', ['data' => $data]);
    }
}
