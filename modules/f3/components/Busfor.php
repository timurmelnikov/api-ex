<?php

namespace app\modules\f3\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

/*
 * Класс работы с данными из Busfor.
 */
class Busfor extends Component
{

    /**
     * Получает договоры по API из Busfor.
     * FIXME: Метод в разработке!!!
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
            ->setUrl(Yii::$app->params['s']['busfor_1']['url'] . Yii::$app->params['s']['busfor_1']['path'])
            ->setHeaders(['Auth-Token' => Yii::$app->params['s']['busfor_1']['token']])
            ->setFormat(Client::FORMAT_RAW_URLENCODED)
            ->setData([
                'from' => $dateFrom . 'T00:00:00.000',
                'to' => $dateTo . 'T00:00:00.000',
                
            ])
            ->send();

        if ($response->isOk) {
            return $response->data;

        } else {
            Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode(). ' Не удалось выполнить запрос.', 'app');
            return null;
        }

    }

}
