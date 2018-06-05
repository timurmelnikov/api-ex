<?php

namespace app\modules\f4\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

/*
 * Класс работы с данными из Busfor.
 */
class Siesta extends Component
{

    /**
     * Получает договоры по API из Busfor. FIXME: Метод в разработке!!!
     *
     * @param string $dateFrom Дата с
     * @param string $dateTo Дата по
     * @param array $state Массив состояний
     *
     * @return mixed
     */
    public function contractGetter($dateFrom, $dateTo)
    {

        set_time_limit(Yii::$app->params['e']['time_limit']);

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
           // ->setUrl(Yii::$app->params['s']['siesta_1']['url'] . Yii::$app->params['s']['siesta_1']['path'])
            ->setUrl('http://resources.finance.ua/ru/public/currency-cash.xml')

        //     ->setHeaders(['Content-Type' => 'text/xml;charset=Windows-1251'])

        // //->setFormat(Client::FORMAT_XML)
        //     ->setData([
        //         'PERIOD_BEG' => $dateFrom,
        //         'PERIOD_END' => $dateTo,
        //         'oauth_token' => Yii::$app->params['s']['siesta_1']['token'],

        //     ])
            ->send();

        //Content-Type: text/xml;charset=windows-1251

        if ($response->isOk) {

            //$a = $response->data;

            //return mb_convert_encoding($response->data, 'windows-1251');
            return $response->data;

        } else {
            Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode() . ' Не удалось выполнить запрос.', 'app');
            return null;
        }

    }

}
