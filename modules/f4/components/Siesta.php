<?php

namespace app\modules\f4\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

/*
 * Класс работы с данными из Siesta.
 */
class Siesta extends Component
{

    /**
     * Получает договоры по API из Siesta.
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
            ->setUrl(Yii::$app->params['s']['siesta_1']['url'] . Yii::$app->params['s']['siesta_1']['path'])
            ->setData([
                'PERIOD_BEG' => $dateFrom,
                'PERIOD_END' => $dateTo,
                'oauth_token' => Yii::$app->params['s']['siesta_1']['token'],
                'DETAIL' => Yii::$app->params['s']['siesta_1']['detail'],

            ])
            ->send();

        if ($response->isOk) {
            return $response->data;

        } else {
            Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode() . ' Не удалось выполнить запрос.', 'app');
            return null;
        }

    }

}
