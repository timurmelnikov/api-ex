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

        $data = null;
        return $this->render('index', ['data' => $data]);
    }
}
