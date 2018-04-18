<?php
/**
 * Пользовательские функции
 */

/**
 * Функция для вывода отладочной информации
 */
function debug($arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}
