<?php

require 'env_switch.php';
require 'params.php';

if ($use_config == 'test') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=' . $params['s']['app_db_test']['host'] . ';dbname=' . $params['s']['app_db_test']['dbname'],
        'username' => $params['s']['app_db_test']['username'],
        'password' => $params['s']['app_db_test']['password'],
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ];
}

if ($use_config == 'go!') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=' . $params['s']['app_db']['host'] . ';dbname=' . $params['s']['app_db']['dbname'],
        'username' => $params['s']['app_db']['username'],
        'password' => $params['s']['app_db']['password'],
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ];

}
