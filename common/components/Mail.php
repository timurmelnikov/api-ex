<?php

namespace app\common\components;

use Exception;
use Yii;
use yii\base\Component;

/*
 * Класс отправки почты
 * Пример:
 * $m = new Mail();
 * $m->subject = 'Я шина-костыль! Прошу на всязь! Прием...';
 * $m->body = '55555';
 * $m->to = [
 *    //'synekop.a@vuso.ua',
 *    'melnikov.t@vuso.ua',
 *    //'krasko.y@vuso.ua',
 *    ];
 * return $m->send();
 */

class Mail extends Component
{
    public $to;
    public $subject;
    public $body;
    public $result;

    public function send()
    {
        try {
            Yii::$app->mailer->compose()
                ->setFrom(\Yii::$app->params['sequrity']['cis@vuso.ua']['username'])
                ->setTo($this->to)
                ->setSubject($this->subject)
                ->setHtmlBody($this->body)
                ->send();
            $data = '{"success": true, "message": "Отправлено: ' . implode(', ', $this->to) . '"}';
        } catch (Exception $e) {
            $data = '{"success": false, "message": "' . $e->getMessage() . '"}';
        }
        return $data;
    }

    //Еще один способ отправки почты:
    // $transport = (new \Swift_SmtpTransport('smtp.office365.com', 587, 'tls'))
    //     ->setUsername(\Yii::$app->params['sequrity']['cis@vuso.ua']['username'])
    //     ->setPassword(\Yii::$app->params['sequrity']['cis@vuso.ua']['password']);

    // $mailer = new \Swift_Mailer($transport);

    // $message = (new \Swift_Message($this->subject))
    //     ->setFrom(['cis@vuso.ua' => 'ВУСО'])
    //     ->setTo($this->to)
    //     ->setBody($this->body);

    // try {
    //     $mailer->send($message);
    //     $data = '{"success": true}';

    // } catch (\Exception $e) {
    //     $data = '"success": false';
    // }

}
