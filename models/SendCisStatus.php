<?php

namespace app\models;

use Yii;

/**
 * Перечисление статусов отправки в КИС.
 *
 * 0   - Статус по умолчанию
 * 100 - успех попадания в КИС
 * 200 - нет необходимости отправки в КИС (дубликат, "незаливабельный статус")
 * 300 - ПреСендер
 * 800 - невозможность попадания в КИС (ошибка)
 * 900 - мои статусы (игнорировать)
 *
 * Для удобства, каждый статус из таблицы - записан через константу вида: STATUS_ИМЯ_СТАТУСА
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $note Примечание
 *
 * @property F2Contract[] $f2Contracts
 */
class SendCisStatus extends \yii\db\ActiveRecord
{

    /**
     * Не определен
     */
    const STATUS_DAFAULT = 0;

    /**
     * Отправлен
     */
    const STATUS_SEND = 100;

    /**
     * Отправлен (не подписан)
     */
    const STATUS_SEND_NO_SIGN = 101;

    /**
     * Удален
     */
    const STATUS_DELETED = 102;

    /**
     * Не нужен
     */
    const STATUS_NOT_NEEDED = 200;

    /**
     * Дубликат
     */
    const STATUS_DUPLICATE = 201;

    /**
     * Отсутствует
     */
    const STATUS_ABSENT = 202;

    /**
     * Обработан ПреСендером
     */
    const STATUS_PROCESSED_PRESENDER = 300;

    /**
     * Ошибка
     */
    const STATUS_ERROR = 800;

    /**
     * Ошибка Пресендера
     */
    const STATUS_ERROR_PRESENDER = 801;

    /**
     * Ошибка Удаления
     */
    const STATUS_ERROR_REMOVER = 802;

    /**
     * Игнорировать
     */
    const STATUS_IGNORE = 900;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%g_e_send_cis_status}}';
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
    public function getF2Contracts()
    {
        return $this->hasMany(F2Contract::className(), ['send_cis_status_id' => 'id']);
    }
}
