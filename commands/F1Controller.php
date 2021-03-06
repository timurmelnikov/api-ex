<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Консольные инициаторы Потока 1
 * @author Timur Melnikov <melnikovt@gmail.com>
 */
class F1Controller extends Controller
{

    /**
     * Получает документы по API партнера.
     * Вызов:
     * .\yii.bat f1/document-getter
     * D:\xampp\htdocs\api-ex\yii.bat f1/document-getter
     * C:\xampp\htdocs\api-ex\yii.bat f1/document-getter
     * 
     * @return void
     */
    public function actionDocumentGetter()
    {
        echo \Yii::$app->params['use_config']."\n";
        echo 'Hello f1 DocumentGetter !!!';
    }

    /**
     * Отправляет документы по API в КИС.
     * Вызов:
     * .\yii.bat f1/document-sender
     * D:\xampp\htdocs\api-ex\yii.bat f1/document-sender
     * C:\xampp\htdocs\api-ex\yii.bat f1/document-sender
     * 
     * @return void
     */
    public function actionDocumentSender()
    {
        echo \Yii::$app->params['use_config']."\n";
        echo 'Hello f1 DocumentSender !!!';
    }

    /**
     * Обрабатывает заявки на страховые случаи
     * посредством обмена (партнер-КИС и КИС-партнер).
     * Вызов:
     * .\yii.bat f1/claim-processor
     * D:\xampp\htdocs\api-ex\yii.bat f1/claim-processor
     * C:\xampp\htdocs\api-ex\yii.bat f1/claim-processor
     * 
     * @return void
     */
    public function actionClaimProcessor()
    {
        echo \Yii::$app->params['use_config']."\n";
        echo 'Hello f1 ClaimProcessor !!!';
    }

}
