<?php

/**
 * Конфигурация аккаунтов систем, с которыми работает приложение
 * Содержит конфиденциальные данные!!!
 * Внимание!!! Используется переключатель конфигураций!!!
 * Структры конфигураций "test" и "go!" - ДОЛЖНЫ СОВПАДАТЬ!
 */

require_once dirname(__FILE__, 2) . '/env_switch.php';

/**
 * Правила именования аккаунтов:
 * pb_1 - ПриватБанк 1
 * cis_user1 - КИС, имя пользователя - user1
 * mail_test@vuso.ua - Постовый ящик - test@vuso.ua
 *
 * Префиксы:
 * app_  - данное приложение
 * pb_   - ПриватБанк
 * cis_  - КИС
 * mail_ - Почта
 *
 * Постфиксы:
 *
 * _test  - тест
 *
 * Пример использования:
 * Выведет на экран токен ПриватБанк 1
 * echo \Yii::$app->params['s']['pb_1']['password'];
 *
 * Пример настроек (поля могут отличатся, в зависимости от необходимости):
 * 'example_1' => [
 *     'description' => '', //Описание
 *     'username' => '', //Имя пользователя
 *     'password' => '', //Пароль
 *     'token' => '', //Токен
 *     'url' => '', //URL
 *     'path' => '', //Путь
 * ],
 */

/**
 * Конфигурация "go!"
 * Настройки БОЕВОЙ среды
 * Переключается в файле "env_switch.php"
 */
if ($use_config == 'go!') {

    return [

        /**
         * БД приложения
         */
        'app_db' => [
            'description' => 'Боевая БД приложения', //Описание
            'username' => 'xxx', //Имя пользователя
            'password' => 'xxx', //Пароль
            'host' => 'xxx', //Хост
            'dbname' => 'xxx', //Имя БД
        ],

        /**
         * Аккаунт ПриватБанк для NBR, HI, SKM, RT.
         * Используется в Потоке 1.
         */
        'pb_1' => [
            'description' => 'ПриватБанк - NBR, HI, SKM, RT',
            'ircId' => 'xxx', //Код страховой компании
            'sid' => 'xxx', //sid
            'password' => 'xxx',
            'urlRequestReport' => 'https://xxx',
            'urlOperate' => 'https://xxx',
        ],

        /**
         * Аккаунт ПриватБанк для прямого импорта ОСАГО.
         * Используется в Потоке 2.
         */
        'pb_2' => [
            'description' => 'Прямой импорт из ПриватБанк',
            'token' => 'xxx',
            'url' => 'https://xxx',
            'path' => '/xxx',
        ],

        /**
         * Пользователь КИС "xxx"
         */
        'cis_privat_bank' => [
            'description' => 'Пользователь КИС "xxx"',
            'username' => 'xxx',
            'password' => 'xxx',
        ],

        /**
         * Настройки аккаунта КИС для всех пользователей
         */
        'cis_all_users' => [
            'url' => 'https://xxx/',
        ],

        /**
         * Аккаунт для отправки почты "xxx@xxx.xx"
         */
        'mail_cis@vuso.ua' => [
            'description' => 'Аккаунт для отправки почты "xxx@xxx.xx"',
            'host' => 'smtp.xxx.xxx',
            'port' => '000',
            'encryption' => 'xxx',
            'username' => 'xxx@xxx.xx',
            'password' => 'xxx',
        ],

        /**
         * Аккаунт Busfor 1.
         * Используется в Потоке 3.
         */
        'busfor_1' => [
            'token' => 'xxx',
            'url' => 'https://xxx.xx',
            'path' => '/xxx/xxx',
        ],
    ];

}

/**
 * Конфигурация "test"
 * Настройки ТЕСТОВОЙ среды (для разработки)
 * Переключается в файле "env_switch.php"
 */
if ($use_config == 'test') {
    return [

        /**
         * БД приложения
         */
        'app_db' => [
            'description' => 'Боевая БД приложения', //Описание
            'username' => 'xxx', //Имя пользователя
            'password' => 'xxx', //Пароль
            'host' => 'xxx', //Хост
            'dbname' => 'xxx', //Имя БД
        ],

        /**
         * Аккаунт ПриватБанк 1 для NBR, HI, SKM, RT.
         * Используется в Потоке 1.
         */
        'pb_1' => [
            'description' => 'ПриватБанк - NBR, HI, SKM, RT',
            'ircId' => 'xxx', //Код страховой компании
            'sid' => 'xxx', //sid
            'password' => 'xxx',
            'urlRequestReport' => 'https://xxx',
            'urlOperate' => 'https://xxx',
        ],

        /**
         * Аккаунт ПриватБанк 2 для прямого импорта ОСАГО.
         * Используется в Потоке 2.
         */
        'pb_2' => [
            'description' => 'Прямой импорт из ПриватБанк',
            'token' => 'xxx',
            'url' => 'https://xxx',
            'path' => '/xxx',
        ],

        /**
         * Пользователь КИС "xxx"
         */
        'cis_privat_bank' => [
            'description' => 'Пользователь КИС "xxx"',
            'username' => 'xxx',
            'password' => 'xxx',
        ],

        /**
         * Настройки аккаунта КИС для всех пользователей
         */
        'cis_all_users' => [
            'url' => 'https://xxx/',
        ],

        /**
         * Аккаунт для отправки почты "xxx@xxx.xx"
         */
        'mail_cis@vuso.ua' => [
            'description' => 'Аккаунт для отправки почты "xxx@xxx.xx"',
            'host' => 'smtp.xxx.xxx',
            'port' => '000',
            'encryption' => 'xxx',
            'username' => 'xxx@xxx.xx',
            'password' => 'xxx',
        ],

        /**
         * Аккаунт Busfor 1.
         * Используется в Потоке 3.
         */
        'busfor_1' => [
            'token' => 'xxx',
            'url' => 'https://xxx.xx',
            'path' => '/xxx/xxx',
        ],
    ];
}
