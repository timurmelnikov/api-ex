<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "g_e_message_type".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $note Примечание
 *
 * @property GMessage[] $gMessages
 */
class MessageType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%g_e_message_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'note' => 'Примечание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGMessages()
    {
        return $this->hasMany(GMessage::className(), ['message_type_id' => 'id']);
    }
}
