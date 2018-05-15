<?php
namespace app\common\helpers;

/**
 * Глобальные хелперы парсинга(разбора).
 */
class Parse
{

    /**
     * Разбор ФИО на части
     * 0-первая часть ФИО, 1-вторая, 2-третья
     * Пример: Parse::fio('Мельников Тимур  Викторович')[1] вернет 'Тимур'
     * 
     * @param string $fio
     * @return array
     */
    public static function fio($fio)
    {
        $fio = preg_replace("/  +/", " ", trim($fio)); // Избавляемся от лишних пробелов
        $spaces = substr_count($fio, ' ');
        $fio_array = preg_split("/[\s]+/", $fio);

        if ($spaces != 2) {
            if (strlen($fio) == 0) {
                $fio_array[0] = '-';
            }
            if (!isset($fio_array[1])) {
                $fio_array[1] = '-';
            }
            if (!isset($fio_array[2])) {
                $fio_array[2] = '-';
            }
        }

        $fio_array[0] = mb_substr($fio_array[0], 0, 29);
        $fio_array[1] = mb_substr($fio_array[1], 0, 29);
        $fio_array[2] = trim(mb_substr(implode(' ', array_splice($fio_array, 2, count($fio_array))), 0, 29));

        return $fio_array;
    }

    /**
     * Расшифровка ИНН
     *
     * @param string $number
     * @return array
     */
    public static function inn($number)
    {
        $result = array();
        $result['number'] = $number;
        $result['sex'] = (substr($number, 8, 1) % 2) ? 'm' : 'f';
        $split = str_split($number);
        $execute = $split[0] * (-1) + $split[1] * 5 + $split[2] * 7 + $split[3] * 9 + $split[4] * 4 + $split[5] * 6 + $split[6] * 10 + $split[7] * 5 + $split[8] * 7;
        $number = substr($number, 0, 5);
        $date = date('d.m.Y', strtotime('01.01.1900 + ' . $number . ' days - 1 days'));
        //list($result['day'], $result['month'], $result['year']) = explode('.', $date);
        $result['birthday'] = date('d.m.Y', strtotime('01.01.1900 + ' . $number . ' days - 1 days'));
        return $result;
    }

}
