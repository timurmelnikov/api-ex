<?php

namespace app\modules\f2\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

/*
 * Класс работы с данными из ПриватБанк
 * Прямой импорт ОСАГО
 */

class PB extends Component
{

    /**
     * Получает договоры по API из ПриватБанк
     * 
     * @param string $dateFrom Дата с
     * @param string $dateTo Дата по
     * @param array $state Массив состояний
     * 
     * @return mixed
     */
    public function contractGetter($dateFrom, $dateTo, $state = ["CONCLUDED"])
    {

        set_time_limit(Yii::$app->params['e']['time_limit']);

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(Yii::$app->params['s']['pb_2']['url'] . Yii::$app->params['s']['pb_2']['path'])
            ->setHeaders(['Authorization' => Yii::$app->params['s']['pb_2']['token']])
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'dateFrom' => $dateFrom.'T00:00:00.000',
                'dateTo' =>  $dateTo.'T00:00:00.000',
                'state' => $state,
            ])
            ->send();

        if ($response->isOk) {
            return $response->data;

        } else {
            Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode());
            return null;
        }

    }

}
