<?php

namespace app\common\components;

use yii\base\Component;
use yii\httpclient\Client;

/**
 * Класс работы с данными из КИС
 */
class Cis extends Component
{

    /**
     * URL КИС-WEB.
     *
     * @var string
     */
    private $url = '';

    /**
     * Имя пользователя для авторизации в КИС-WEB.
     *
     * @var string
     */
    public $username;

    /**
     * Павроль пользователя для авторизации в КИС-WEB.
     *
     * @var string
     */
    public $password;

    /**
     * Сессия авторизации
     *
     * @var string
     */
    protected $session;

    public function __construct()
    {
        //set_time_limit(300);
        $this->url = \Yii::$app->params['s']['cis_all_users']['url'];

        //$this->client = new Client();
        //$this->login();
        //sleep(1);
    }

    public function __destruct()
    {
        $this->logout();
    }

    /**
     * Авторизация в КИС-WEB
     *
     * @return mixed
     */
    private function CisLogin()
    {

        $client = new Client();

        $request_data = [
            'login' => \Yii::$app->params['sequrity']['CISPBDirectImport']['username'],
            'pass' => \Yii::$app->params['sequrity']['CISPBDirectImport']['password'],
        ];
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($this->url . '/cis/auth/login')
            ->setData($request_data)
            ->send();

        if ($response->isOk) {
            $this->session = $response->headers->get('set-cookie');
            $data = $response->data;

        } else {
            $data = ['success' => 'false'];
        }

        return $data;

    }

    /**
     * Выход из КИС-WEB
     *
     * @return void
     */
    private function CisLogout()
    {

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($this->url . '/cis/auth/logoff')
            ->addHeaders([
                'Cookie' => $this->session,
            ])
            ->send();
    }

    /**
     * Вызов API КИС-WEB
     * Значения режимов ($mode):
     * 0 - URL-кодированная строка - 'series=%D0%90%D0%9A&number=8131803'
     * 1 - Договор (HI, NBR  и т.п.). Тело запроса - 'CreateContract=1&formData='+ДАННЫЕ ЗАПРОСА+'&is_load_json=1'
     *
     * @param string $path Метод
     * @param array $requestData Данные запроса
     * @param int $mode Режим
     *
     * @return mixed
     */
    public function CisRequest($path, $requestData, $mode = 0)
    {

        set_time_limit(Yii::$app->params['e']['time_limit']);

        /**
         * Подготовка данных запроса
         */
        switch ($mode) {
            case 0:
                $requestData = http_build_query($requestData);
                break;
            case 1:
                $requestData = 'CreateContract=1&formData=' . rawurlencode(json_encode($request_data, JSON_UNESCAPED_UNICODE)) . '&is_load_json=1';
                break;
        }

        $response = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl($this->url . $path)
            ->addHeaders([
                'Cookie' => $this->session,
            ])
            ->addHeaders([
                'Content-Type' => 'text/plain;charset=UTF-8',
            ])
            ->setContent($requestData)
            ->setOptions([])
            ->send();

        if ($response->isOk) {
            return $response->data;
        } else {
            Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode());
            return null;
        }

    }

}