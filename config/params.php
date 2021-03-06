<?php

/**
 * Конфигурация параметров приложения.
 * Внимание!!! Используется переключатель конфигураций!!!
 * Структры конфигураций "test" и "go!" - ДОЛЖНЫ СОВПАДАТЬ!
 *
 *
 * Пример использования:
 * Выведет на экран временную задержку выполнения скрипта PHP
 * echo \Yii::$app->params['e']['time_limit'];
 */

require_once 'env_switch.php';

/**
 * Конфигурация "go!".
 * Настройки БОЕВОЙ среды.
 * Переключается в файле "env_switch.php".
 */
$app_envirment_go = [

    /**
     * Время выполнения действия. Для set_time_limit() в методах.
     */
    'time_limit' => 300,

    /**
     * Настройки Потока 1.
     */
    'f1' => [],

    /**
     * Настройки Потока 2.
     */
    'f2' => [

        /**
         * За сколько дней забирать данные из ПривтБанк.
         */
        'report_days' => 5,
    ],

    /**
     * Настройки Потока 3.
     */
    'f3' => [

        /**
         * За сколько дней забирать данные из Busfor.
         */
        'report_days' => 5,
    ],

    /**
     * Настройки Потока 4.
     */
    'f4' => [

        /**
         * За сколько дней забирать данные из Siesta.
         */
        'report_days' => 5,
    ],
];

/**
 * Конфигурация "test".
 * Настройки ТЕСТОВОЙ среды (для разработки).
 * Переключается в файле "env_switch.php".
 */
$app_envirment_test = [

    /**
     * Время выполнения действия. Для set_time_limit() в методах.
     */
    'time_limit' => 300,

    /**
     * Настройки Потока 1.
     */
    'f1' => [],

    /**
     * Настройки Потока 2.
     */
    'f2' => [

        /**
         * За сколько дней забирать данные из ПривтБанк.
         */
        'report_days' => 5,
    ],

    /**
     * Настройки Потока 3.
     */
    'f3' => [

        /**
         * За сколько дней забирать данные из Busfor.
         */
        'report_days' => 5,
    ],

    /**
     * Настройки Потока 4.
     */
    'f4' => [

        /**
         * За сколько дней забирать данные из Siesta
         */
        'report_days' => 5,
    ],

];

if ($use_config == 'go!') {
    $app_envirment = $app_envirment_go;
}

if ($use_config == 'test') {
    $app_envirment = $app_envirment_test;
}

return [

    /**
     * Краткое имя приложения.
     */
    'shortName' => 'API Exchange',

    /**
     * Версия.
     */
    'version' => '0.6.0',

    /**
     * Подключение конфикга с паролями и токенами.
     * Папка /common/security внесена в .gitignore.
     * "s" - sequrity (безопасность).
     */
    's' => require 'security/accounts.php',

    /**
     * Подключение конфикга с настройками окружений.
     * Управляется в файле env_switch.php.
     * "e" - envirment (окружение).
     */
    'e' => $app_envirment,

    /**
     * Доступ к имени используемой конфигурации
     * для использования в приложении ("go!" или "test").
     */
    'use_config' => $use_config,

];
