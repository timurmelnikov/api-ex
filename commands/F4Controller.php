<?php

namespace app\commands;

use yii\console\Controller;
use app\modules\f4\models\Contract;

/**
 * Консольные инициаторы Потока 4.
 * @author Timur Melnikov <melnikovt@gmail.com>
 */
class f4Controller extends Controller
{

    /**
     * Получает документы по API партнера.
     * Вызов:
     * .\yii.bat f4/document-getter
     * D:\xampp\htdocs\api-ex\yii.bat f4/document-getter
     * C:\xampp\htdocs\api-ex\yii.bat f4/document-getter
     *
     * @return void
     */
    public function actionDocumentGetter()
    {

        echo \Yii::$app->params['use_config'] . "\n";
        
        // $contract = new Contract();
        // $contract->contractGetter();

        echo 'Готово.';
    }

    /**
     * Отправляет документы по API в КИС.
     * Вызов:
     * .\yii.bat f4/document-sender
     * D:\xampp\htdocs\api-ex\yii.bat f4/document-sender
     * C:\xampp\htdocs\api-ex\yii.bat f4/document-sender
     *
     * @return void
     */
    public function actionDocumentSender()
    {
        echo \Yii::$app->params['use_config'] . "\n";

        //Вставка договора в КИС
        // $contract = new Contract();
        // $data = $contract->contractSender();

        echo 'Готово.';
    }

}
