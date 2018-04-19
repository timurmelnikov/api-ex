<?php

namespace app\commands;

use yii\console\Controller;
use app\modules\f2\models\Contract;

/**
 * Консольные инициаторы Потока 2
 * @author Timur Melnikov <melnikovt@gmail.com>
 */
class F2Controller extends Controller
{

    /**
     * Получает документы по API партнера
     * Вызов:
     * .\yii.bat f2/document-getter
     * D:\xampp\htdocs\api-ex\yii.bat f2/document-getter
     * C:\xampp\htdocs\api-ex\yii.bat f2/document-getter
     * @return null
     * TODO: метод, не должен возвращать null (указать тип!!!)
     */
    public function actionDocumentGetter()
    {
        
        $contract = new Contract();
        $contract->contractGetter();
        
        echo 'Готово.';
    }

    /**
     * Отправляет документы по API в КИС
     * Вызов:
     * .\yii.bat f2/document-sender
     * D:\xampp\htdocs\api-ex\yii.bat f2/document-sender
     * C:\xampp\htdocs\api-ex\yii.bat f2/document-sender
     * @return null
     * TODO: метод, не должен возвращать null (указать тип!!!)
     */
    public function actionDocumentSender()
    {
        echo 'Hello f2 DocumentSender !!!';
    }

   

}
