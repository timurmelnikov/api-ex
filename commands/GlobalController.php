<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Глобальные консольные инициаторы (для всего приложения)
 * @author Timur Melnikov <melnikovt@gmail.com>
 */
class GlobalController extends Controller
{

    /**
     * Отправляет почтовые сообщения
     * Вызов:
     * .\yii.bat global/mail-sender
     * D:\xampp\htdocs\api-ex\yii.bat global/mail-sender
     * C:\xampp\htdocs\api-ex\yii.bat global/mail-sender
     * @return null
     * TODO: метод, не должен возвращать null (указать тип!!!)
     */
    public function actionMailSender()
    {
        echo 'Hello Global MailSender !!!';
    }

}
