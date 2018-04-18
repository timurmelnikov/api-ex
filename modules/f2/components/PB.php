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

    public function init(){

        Yii::warning('init');

    }

    /**
     * Получает договоры из ПриватБанк
     *
     * @return mixed
     */
    public function contractGetter()
    {

        set_time_limit(Yii::$app->params['time_limit']);

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(Yii::$app->params['s']['pb_2']['url'] . Yii::$app->params['s']['pb_2']['path'])
            ->setHeaders(['Authorization' => Yii::$app->params['s']['pb_2']['token']])
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'dateFrom' => "2018-04-17T00:00:00.000",
                'dateTo' => "2018-04-18T00:00:00.000",
                'state' => ["CONCLUDED"],
            ])
            ->send();

        if ($response->isOk) {
            //return ['success' => 1, 'message' => $response->getStatusCode(), 'data' => $response->data];
            
          
            return $response->data;

        } else {
            Yii::error(__METHOD__ . ': Ошибка - ' . $response->getStatusCode());
            //return ['success' => 0, 'message' => $response->getStatusCode()];
            return null;
        }

    }

}
