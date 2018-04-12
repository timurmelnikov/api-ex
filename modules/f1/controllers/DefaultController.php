<?php

namespace app\modules\f1\controllers;

use app\common\Controller;

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
        return $this->render('index');
    }
}
