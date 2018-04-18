<?php

require 'env_switch.php';

return [


    /**
     * Подключение конфикга с паролями и токенами
     * папка /common/security внесена в .gitignore
     */
    's' => require 'security/accounts.php', 
    
    /**
     * Краткое имя приложения
     */
    'shortName' => 'API Exchange',
    
    /**
     * Версия
     */
    'version' => '0.0.1-dev',

    /**
     * Время выполнения действия. Для set_time_limit() в методах
     * Использование: set_time_limit(Yii::$app->params['time_limit']);
     * 
     * FIXME: Реализовать в dev/prod
     */
    'time_limit' => 300,
];
