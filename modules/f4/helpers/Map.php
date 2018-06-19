<?php
namespace app\modules\f4\helpers;

use app\modules\f4\models\Country;

/**
 * Хелперы мапинга.
 * Статические методы для замены одного значения другим
 */
class Map extends \app\common\helpers\Map
{

    /**
     * Замена территории покрытия
     *
     * @param string $value
     * @return integer
     */
    public static function coveringTerritory($value)
    {

        switch ($value) {
            case 'EU':return 7;
                break;
            case 'WW-1':return 8;
            default:return 8;

        }

    }

    /**
     * Замена страны назначения
     *
     * @param string $value
     * @return integer
     */
    public static function countryDestination($value)
    {
        try {
            return Country::find()->where(['code' => $value])->one()->id_country;
        } catch (\Exception $e) {
            return 1; //Если, вдруг страны не найдет - вернет Украину
        }
    }
   

}