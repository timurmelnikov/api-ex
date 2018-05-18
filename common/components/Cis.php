<?php

namespace app\common\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

/**
 * Работа с КИС
 */
class Cis extends Component
{

    /**
     * Константа для метода cisRequest()
     * URL-кодированная строка - 'series=%D0%90%D0%9A&number=8131803'
     */
    const MODE_URL_CODE = 0;

    /**
     * Константа для метода cisRequest()
     * Договор (HI, NBR  и т.п.). Тело запроса - 'CreateContract=1&formData='+ДАННЫЕ ЗАПРОСА+'&is_load_json=1'
     */
    const MODE_CONTRACT = 1;

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

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->url = \Yii::$app->params['s']['cis_all_users']['url'];
        $this->cisLogin();
        sleep(1);
    }

    /**
     * Деструктор
     */
    public function __destruct()
    {
        $this->cisLogout();
    }

    /**
     * Авторизация в КИС-WEB
     *
     * @return void
     */
    private function cisLogin()
    {

        set_time_limit(Yii::$app->params['e']['time_limit']);

        $request_data = [
            'login' => $this->username, //\Yii::$app->params['s']['cis_privat_bank']['username'],
            'pass' => $this->password, //\Yii::$app->params['s']['cis_privat_bank']['password'],
        ];

        $client = new Client();

        try {
            $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl($this->url . '/cis/auth/login')
                ->setData($request_data)
                ->send();

            if ($response->isOk) {
                $this->session = $response->headers->get('set-cookie');
            } else {
                Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode() . ' Не удалось авторизироваться.', 'app');
            }

        } catch (\Exception $e) {
            Yii::error(__METHOD__ . ': Ошибка - ' . $e->getMessage() . ' Не удалось авторизироваться (Исключение HTTP клиента).', 'app');
        }
    }

    /**
     * Выход из КИС-WEB
     *
     * @return void
     */
    private function cisLogout()
    {
        set_time_limit(Yii::$app->params['e']['time_limit']);

        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($this->url . '/cis/auth/logoff')
            ->addHeaders(['Cookie' => $this->session])
            ->send();
    }

    /**
     * Вызов API КИС-WEB
     * Значения режимов ($mode):
     * 0 - MODE_URL_CODE - URL-кодированная строка - 'series=%D0%90%D0%9A&number=8131803'
     * 1 - MODE_CONTRACT - Договор (HI, NBR  и т.п.). Тело запроса - 'CreateContract=1&formData='+ДАННЫЕ ЗАПРОСА+'&is_load_json=1'
     *
     * Важно!!! При добавлении нового режима, добавить константу!!!
     *
     * @param string $path Метод
     * @param array $requestData Данные запроса
     * @param int $mode Режим
     *
     * @return mixed
     */
    public function cisRequest($path, $requestData, $mode = 0)
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
                $requestData = 'CreateContract=1&formData=' . rawurlencode(json_encode($requestData, JSON_UNESCAPED_UNICODE)) . '&is_load_json=1';
                break;
        }

        $client = new Client();

        try {

            $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl($this->url . $path)
                ->addHeaders(['Cookie' => $this->session])
                ->addHeaders(['Content-Type' => 'text/plain;charset=UTF-8'])
                ->setContent($requestData)
                ->setOptions([])
                ->send();

            if ($response->isOk) {
                return $response->data;
            } else {
                Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode() . ' Не удалось выполнить запрос к КИС-WEB.', 'app');
                return 'Ошибка - ' . $response->getStatusCode() . ' Не удалось выполнить запрос к КИС-WEB.';
            }

        } catch (\Exception $e) {
            Yii::error(__METHOD__ . ': Ошибка - ' . $e->getMessage() . ' Не удалось выполнить запрос к КИС-WEB (Исключение HTTP клиента).', 'app');
            return ' Ошибка - ' . $e->getMessage() . ' Не удалось выполнить запрос к КИС-WEB (Исключение HTTP клиента).';
        }

    }

}
