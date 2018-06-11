<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "g_e_message_status".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $note Примечание
 *
 * @property GMessage[] $gMessages
 */
class MessageStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%g_e_message_status}}';
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
        return $this->hasMany(GMessage::className(), ['message_status_id' => 'id']);
    }
}
