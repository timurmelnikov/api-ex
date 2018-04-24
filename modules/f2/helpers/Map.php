<?php
namespace app\modules\f2\helpers;

/**
 * Хелперы мапинга.
 * Статические методы для замены одного значения другим
 */
class Map
{

    /**
     * Замена ID Места регистрации МТСБУ на ID КИС
     * Для тех, что не находит API КИС
     *
     * @param int $value
     * @return int
     */
    public static function idPlace($value)
    {

        switch ($value) {
            case 3345:return 41949; //ТЗ зареестровані в iнших краiнах
                break;
            case 3603:return 33681; //Гадяч
                break;
            default:return null;
        }

    }

    /**
     * Замена серии бланка с латиницы на кириллицу
     *
     * @param string $value
     * @return string
     */
    public static function blankSeries($value)
    {

        switch ($value) {
            case 'AK':return 'АК';
                break;
            default:return $value;
        }

    }

    /**
     * Мапер Бонус-Малуса
     *
     * @param int $value
     * @return double
     */
    public static function bonusMalus($value)
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

    /**
     * Мапер использования в месяце
     *
     * @param int $value
     * @return boolean
     */
    public static function isActive($value)
    {

        switch ($value) {
            case 1:return false;
                break;
            case 0:return true;
                break;

        }
    }

}
