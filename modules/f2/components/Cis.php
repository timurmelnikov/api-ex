<?php

namespace app\modules\f2\components;

//use app\common\classes\Parsers;
use yii\base\Component;
use yii\httpclient\Client;

/**
 * Класс работы с данными из КИС
 */
class Cis extends Component
{

    /**
     * URL
     * Боевая - 'https://cis.vuso.ua';
     * Тестовая - 'https://test.vuso.ua';
     * @var string
     */
    protected $url = '';
    //protected $url = 'https://cis.vuso.ua'; //Боевая
    //protected $url = 'https://test.vuso.ua';  //Тестовая
    /**
     * Сессия авторизации
     * @var string
     */
    protected $session;
    /**
     * Экземпляр HTTP клиента
     * @var Client
     */
    protected $client;
    /**
     * Лимит времени віполнения PHP скрипта
     * @var int
     */
    protected $timeLimit = 300;

    public function __construct()
    {
        set_time_limit(300);
        $this->url = \Yii::$app->params['settings']['f2']['cisUrl'];
        $this->client = new Client();
        $this->login();
        sleep(1);
    }

    public function __destruct()
    {
        $this->logout();
    }

    /**
     * Метод авторизации в КИС
     */
    private function login()
    {
        $request_data = [
            'login' => \Yii::$app->params['sequrity']['CISPBDirectImport']['username'],
            'pass' => \Yii::$app->params['sequrity']['CISPBDirectImport']['password'],
        ];
        $response = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl($this->url . '/cis/auth/login')
            ->setData($request_data)
            ->send();

        if ($response->isOk) {
            $this->session = $response->headers->get('set-cookie');
            $data = $response->data;
            //$data = $this->session = $response->headers->get('set-cookie');
        } else {
            $data = ['success' => 'false'];
        }

        return $data;

    }

    /**
     * Выход из КИС
     */
    private function logout()
    {
        $response = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl($this->url . '/cis/auth/logoff')
            ->addHeaders([
                'Cookie' => $this->session,
            ])
            ->send();
    }

}
