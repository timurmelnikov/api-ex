<?php

namespace app\commands;

use yii\console\Controller;
use app\modules\f3\models\Contract;

/**
 * Консольные инициаторы Потока 3.
 * @author Timur Melnikov <melnikovt@gmail.com>
 */
class F3Controller extends Controller
{

    /**
     * Получает документы по API партнера.
     * Вызов:
     * .\yii.bat f3/document-getter
     * D:\xampp\htdocs\api-ex\yii.bat f3/document-getter
     * C:\xampp\htdocs\api-ex\yii.bat f3/document-getter
     *
     * @return void
     */
    public function actionDocumentGetter()
    {

        echo \Yii::$app->params['use_config'] . "\n";
        
        $contract = new Contract();
        $contract->contractGetter();

        echo 'Готово.';
    }

    /**
     * Отправляет документы по API в КИС.
     * Вызов:
     * .\yii.bat f3/document-sender
     * D:\xampp\htdocs\api-ex\yii.bat f3/document-sender
     * C:\xampp\htdocs\api-ex\yii.bat f3/document-sender
     *
     * @return void
     */
    public function actionDocumentSender()
    {
        echo \Yii::$app->params['use_config'] . "\n";

        //Вставка договора в КИС
        $contract = new Contract();
        $data = $contract->contractSender();

        echo 'Готово.';
    }

}
