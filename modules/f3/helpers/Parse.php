<?php
namespace app\modules\f3\helpers;



/**
 * Хелперы парсинга(разбора).
 */
class Parse extends \app\common\helpers\Parse
{

      /**
     * Конвертирование денежных сумм из копеек в гривны
     * Busfor - показывает суммы в копейках
     *
     * @param float $value
     * @return float
     */
    public static function moneyConvert($value)
    {

        return $value / 100;

    }
    
}
