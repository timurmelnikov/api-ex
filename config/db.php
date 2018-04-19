<?php

require_once 'params.php';

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
