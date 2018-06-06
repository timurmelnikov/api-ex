<?php

namespace app\modules\f4\controllers;

use yii\web\Controller;
use app\modules\f4\components\Siesta;

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

        $s = new Siesta();
        
        
        $data = $s->contractGetter(20180601, 20180606);
        //$data = null;
        return $this->render('index', ['data' => $data]);
    }
}
