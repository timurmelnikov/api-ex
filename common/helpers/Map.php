<?php
namespace app\common\helpers;

/**
 * Хелперы мапинга.
 * Хелперов, может быть несколько. По этому вконце ставится цифра.
 * Например: bonusMalus1, bonusMalus2
 */
class Map
{

    /**
     * Мапер Бонус-Малуса
     * Вариант 1
     * 0 = 2,3
     * 1 = 1,55
     * 2 = 1,4
     * 3 = 1
     * 4 = 0,95
     * 5 = 0,9
     * 6 = 0,85
     * 7 = 0,8
     *
     * @param int $value
     * @return void
     */
    public static function bonusMalus1($value)
    {

        switch ($value) {
            case 0:return 2.3;
                break;
            case 1:return 1.55;
                break;
            case 2:return 1.4;
                break;
            case 3:return 1;
                break;
            case 4:return 0.95;
                break;
            case 5:return 0.9;
                break;
            case 6:return 0.85;
                break;
            case 7:return 0.8;
                break;
            default:return 1;

        }

    }

}
