<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "g_message".
 *
 * @property int $id
 * @property int $message_type_id ID типа
 * @property int $message_status_id ID статуса
 * @property string $message_status_text Сообщение об отправке или ошибке
 * @property string $subject Тема
 * @property string $body Текст сообщения
 * @property string $send_to Кому (через ","
 * @property string $insert_date Дата создания
 * @property string $send_after Отправить после
 * @property string $send_date Дата отправки
 *
 * @property GEMessageStatus $messageStatus
 * @property GEMessageType $messageType
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'g_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message_type_id', 'message_status_text', 'subject', 'body', 'send_to', 'send_after'], 'required'],
            [['message_type_id', 'message_status_id'], 'integer'],
            [['message_status_text', 'body'], 'string'],
            [['insert_date', 'send_after', 'send_date'], 'safe'],
            [['subject', 'send_to'], 'string', 'max' => 250],
            [['message_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessageStatus::className(), 'targetAttribute' => ['message_status_id' => 'id']],
            [['message_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MessageType::className(), 'targetAttribute' => ['message_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_type_id' => 'ID типа',
            'message_status_id' => 'ID статуса',
            'message_status_text' => 'Сообщение об отправке или ошибке',
            'subject' => 'Тема',
            'body' => 'Текст сообщения',
            'send_to' => 'Кому (через запятую)',
            'insert_date' => 'Дата создания',
            'send_after' => 'Отправить после',
            'send_date' => 'Дата отправки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageStatus()
    {
        return $this->hasOne(MessageStatus::className(), ['id' => 'message_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageType()
    {
        return $this->hasOne(MessageType::className(), ['id' => 'message_type_id']);
    }

    /**
     * Отправка почты адресатам
     *
     * @return void
     */
    public function sendMail()
    {

    }

    /**
     * Отправка SMS адресатам
     *
     * @return void
     */
    public function sendSms()
    {

    }

}
