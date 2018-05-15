<?php
namespace app\modules\f2\helpers;

/**
 * Глобальные хелперы мапинга(замены) Потока 2.
 */
class Map
{

    /**
     * Замена ID Места регистрации МТСБУ на ID КИС
     * Для тех, что не находит API КИС (таблица - B_ADDR_PLACES_KOATUU)
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
            case 189:return 4837; //Кременець
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
     * Мапер использования авто в году
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

    /**
     * Мапер ТВП от франшизы
     *
     * @param int $value
     * @return float
     */
    public static function tvp($value)
    {

        switch ($value) {
            case 1000:return 51.43;
                break;
            case 0:return 44.00;
                break;

        }
    }

    /**
     * Возвращает ID типа документа - удостоверения личности.
     * Таблица КИС - C_INI_DOC_TYPES
     *
     * @param int $value
     * @return int
     */
    public static function idDocType($value)
    {

        switch ($value) {
            case 'Паспорт':return 11;
                break;
            case 'Посвідчення водія':return 14;
                break;
            default:return 11; //По умолчанию - паспорт

        }
    }

    /**
     * Возвращает ID Категории авто.
     * Таблица КИС - O_INI_AUTO_CATEGORIES
     * что приходят в поле "c_type" категориям в таблице O_INI_AUTO_CATEGORIES
     *
     * @param int $value
     * @return mixed
     */
    public static function idAutoCategory($value)
    {

        switch ($value) {
            case 5:return 1;
                break;
            case 6:return 2;
                break;
            case 1:return 3;
                break;
            case 2:return 4;
                break;
            case 3:return 5;
                break;
            case 4:return 6;
                break;
            case 7:return 7;
                break;
            case 8:return 8;
                break;
            case 9:return 9;
                break;
            case 10:return 10;
                break;
            case 12:return 11;
                break;
            case 11:return 12;
                break;
            default:return null;

        }

    }

}
