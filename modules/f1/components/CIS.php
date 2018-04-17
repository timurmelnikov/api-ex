<?php

namespace app\modules\f1\components;

use yii\base\Component;

/**
 * Компонент работы с API CIS для
 * отправки/получения документов и статусов
 */
class CIS extends Component
{

    /**
     * @var string Хост CIS
     */
    private $host = 'http:/xxx.xx';

    /**
     * @inheritdoc
     */
    public function init()
    {

    }

    /**
     * Отправка запроса к API CIS
     *
     * TODO: После реализации, описать phpDoc!
     */
    public function sendRequest()
    {

        return null;
    }

}
