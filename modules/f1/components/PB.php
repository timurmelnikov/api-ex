<?php

namespace app\modules\f1\components;

use yii\base\Component;

/**
 * Компонент работы с API ПриватБанка для
 * получения документов и отправки статусов
 */
class PB extends Component
{

    /**
     * @var integer Получение данных из ПриватБанк
     */
    const TYPE_GET_DATA = 1;

    /**
     * @var integer Отправка данных в ПриватБанк
     */
    const TYPE_SEND_STATUS = 2;

    /**
     * @var string Хост ПриватБанка
     */
    private $host = 'http:/xxx.xx';

    /**
     * @inheritdoc
     */
    public function init()
    {

    }

    /**
     * Отправка запроса к API ПриватБанк
     *
     * @param [type] $type
     * @param [type] $jsonParametr
     * @return void TODO: Определиться с возвращаемім типом!!!
     */
    public function sendRequest($type = self::TYPE_GET_DATA, $jsonParametr)
    {

        return $jsonParametr;
    }

}
