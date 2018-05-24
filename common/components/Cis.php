<?php

namespace app\common\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

/**
 * Абстрактный класс работы с API КИС-WEB
 */
abstract class Cis extends Component
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
    public function cisRequest($path, $requestData, $mode = self::MODE_URL_CODE)
    {

        set_time_limit(Yii::$app->params['e']['time_limit']);

        /**
         * Подготовка данных запроса
         */
        switch ($mode) {
            case self::MODE_URL_CODE:
                $requestData = http_build_query($requestData);
                break;
            case self::MODE_CONTRACT:
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

    /**
     * Поиск договора в КИС-WEB по номеру
     *
     * @param string $reg_num Регистрационный номе договора
     *
     * Возвращает:
     * 1) id_doc - Один из договоров в КИС - найден (Договоров, может быть несколько)
     * 2) false - Договор в КИС не найден
     * 3) Все, что вернул метод /cis/utils/docs_by_vin_num_fio. В этом случае - не понятно есть договор в КИС или нет.
     * @return array
     */
    public function contractSearchByNumber($reg_num)
    {

        $data = $this->cisRequest('/cis/utils/docs_by_vin_num_fio', ['reg_num' => $reg_num]);
        if (isset($data[0]['id_doc'])) {
            return [
                'success' => true,
                'id_doc' => $data[0]['id_doc'],
            ]; //Один из договоров в КИС - найден (Договоров, может быть несколько)
        } else if (isset($data[0]['message'])) {
            if ($data[0]['message'] == 'За вказаними вхідними параметрами не знайдено жодного договору страхування!') {
                return [
                    'success' => true,
                    'id_doc' => null,
                ]; //Договор в КИС не найден
            } else {
                return [
                    'success' => false,
                    'id_doc' => null,
                ]; //Не известно - найден договор или нет
            }
        } else {
            return [
                'success' => false,
                'id_doc' => null,
            ]; //Не известно - найден договор или нет
        }
    }

}
