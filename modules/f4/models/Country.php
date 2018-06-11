<?php

namespace app\modules\f4\models;

use Yii;

/**
 * This is the model class for table "f4_d_country".
 *
 * @property int $id
 * @property int $id_country ID страны (Сиеста)
 * @property string $country_name_rus Наименование страны
 * @property string $code Код страны
  */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%f4_d_country}}';
    }

}
