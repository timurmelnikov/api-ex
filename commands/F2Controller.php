<?php

namespace app\commands;

use yii\console\Controller;
use app\modules\f2\models\Contract;

/**
 * Консольные инициаторы Потока 2.
 * @author Timur Melnikov <melnikovt@gmail.com>
 */
class F2Controller extends Controller
{

    /**
     * Получает документы по API партнера.
     * Вызов:
     * .\yii.bat f2/document-getter
     * D:\xampp\htdocs\api-ex\yii.bat f2/document-getter
     * C:\xampp\htdocs\api-ex\yii.bat f2/document-getter
     * 
     * @return void
     */
    public function actionDocumentGetter()
    {
        
        echo \Yii::$app->params['use_config']."\n";

        $contract = new Contract();
        $contract->contractGetter();
        
        echo 'Готово.';
    }

    /**
     * Отправляет документы по API в КИС.
     * Вызов:
     * .\yii.bat f2/document-sender
     * D:\xampp\htdocs\api-ex\yii.bat f2/document-sender
     * C:\xampp\htdocs\api-ex\yii.bat f2/document-sender
     * 
     * @return void
     */
    public function actionDocumentSender()
    {
        echo \Yii::$app->params['use_config']."\n";
        echo 'Hello f2 DocumentSender !!!';
    }

   

}
