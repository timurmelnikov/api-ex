<?php

namespace app\modules\f2\controllers;

use yii\web\Controller;
use app\modules\f2\models\Contract;
use app\modules\f2\components\Cis;

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
        //$cis = new Cis();
        //$data = $cis->idBlankGetter('АК', '8131803');
        //$data = $cis->idPlaceGetter(42);

        $contract = new Contract();
        $contract->contractPreSender();

        $data = 1;

        return $this->render('index', ['data' => $data]);
    }
}
