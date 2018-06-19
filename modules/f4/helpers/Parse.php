<?php
namespace app\modules\f4\helpers;

/**
 * Хелперы парсинга(разбора).
 */
class Parse extends \app\common\helpers\Parse
{

    /**
     * Приведение даты к формату, что принимает API CIS
     * Метод переопределен из базового класса \app\common\helpers\Parse
     * Артисты из Сиесты, иногда передают пустой массив вместо пустой строки, если дата не заполнена
     *
     * @param string $date Строка с датой
     * @param string $format Форматы возврщаемой даты: 's' (short) - '01.01.2000', 'f' (full) - '01.01.2000 01:01'
     * @param int $offset Смещение (в часах). Может быть как положительным так и отрицательным
     * @return string
     */
    public static function dateCis($date, $format = 's', $offset = 0)
    {
        if (is_string($date)) {
            if ($format == 's') {
                return date('d.m.Y', strtotime($date) + ($offset * 3600));
            }
            if ($format == 'f') {
                return date('d.m.Y H:i', strtotime($date) + ($offset * 3600));
            }
        } else {
            return '';
        }
    }

}
