<?php

return [
    /**
     * Подключение конфикга с паролями и токенами
     * папка /common/security внесена в .gitignore
     */
    's' => require dirname( __FILE__, 2 ) . '/common/security/accounts.php', 
    
    /**
     * Краткое имя приложения
     */
    'shortName' => 'API Exchange',
    
    /**
     * Версия
     */
    'version' => '0.0.1-dev'

];
