<?php

namespace app\modules\f1\components;

use yii\base\Component;
use yii\httpclient\Client;

/**
 * Компонент работы с API ПриватБанка для FIXME: Класс в разработке
 * получения документов и отправки статусов
 */
class PB extends Component
{

    /**
     * @inheritdoc
     */
    public function init()
    {

    }

    /**
     * Отправка запроса на получение данных к API ПриватБанк
     * Мы забираем (https://docs.google.com/document/d/1lxP-xoks_350dZJzF_iLjnEYzj9EtumfLfSqqzrgW3w/edit?ts=59ad24f2#heading=h.ceo422gmsf5)

     * @param array requestData Параметры запроса отчета
     * @return mixed
     */
    private function requestReport($requestData)
    {

        $client = new Client(['transport' => 'yii\httpclient\CurlTransport']);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(\Yii::$app->params['s']['pb_1']['urlRequestReport'])
            ->setHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'sid' => \Yii::$app->params['s']['pb_1']['sid'],
            ])
            ->setOptions([
                CURLOPT_SSLKEY => \Yii::getAlias('@app') . '/config/security/pb_1_certificates/key.pem',
                CURLOPT_SSLCERT => \Yii::getAlias('@app') . '/config/security/pb_1_certificates/19dec_cert.pem',
                CURLOPT_KEYPASSWD => \Yii::$app->params['s']['pb_1']['password'],
            ])
            ->setFormat(Client::FORMAT_JSON)
            ->setData($requestData)
            ->send();

        if ($response->isOk) {
            return $response->data;
        } else {
            return ['success' => 'false'];
        }
    }

    /**
     * Отправка запроса на изменение данных к API ПриватБанк
     *
     * @param [type] $type
     * @param [type] $jsonParametr
     * @return mixed
     */
    public function sendOperate($type = self::TYPE_GET_DATA, $jsonParametr)
    {

        return $jsonParametr;
    }

    /**
     * Получение договоров
     *
     * @param string $date Дата отчета
     * @param string $tlCode Вид страхования
     * @return mixed
     */
    public function contractGetter($date, $tlCode)
    {

        return $this->requestReport([
            "date" => $date,
            "tlCode" => $tlCode,
            "ircId" => \Yii::$app->params['s']['pb_1']['ircId'],
            "reportCode" => 'DR',
        ]);

    }

    /**
     * Получение заявок на стразовые случаи
     *
     * @param string $date Дата отчета
     * @param string $tlCode Вид страхования
     * @return mixed
     */
    public function claimGetter($date, $tlCode)
    {
        return $this->requestReport([
            "date" => $date,
            "tlCode" => $tlCode,
            "ircId" => \Yii::$app->params['s']['pb_1']['ircId'],
            "reportCode" => 'AR',
        ]);

    }

}
