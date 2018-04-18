<?php

namespace app\modules\f2\models;

use Yii;

/**
 * This is the model class for table "f2_contract".
 *
 * @property int $id
 * @property string $insert_date Дата создания записи
 * @property string $contract_id ID договора
 * @property string $sagr Серия договора
 * @property string $nagr № договора
 * @property string $data_json Данные JSON
 * @property string $send_cis_date Дата успешной отправки в КИС
 * @property string $send_cis_message Сообщение об отправке в КИС
 * @property int $send_cis_status_id Статус отправки в КИС
 * @property int $id_cis ID КИС
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f2_contract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date', 'send_cis_date'], 'safe'],
            [['contract_id', 'sagr', 'nagr', 'data_json', 'send_cis_message', 'send_cis_status_id'], 'required'],
            [['data_json', 'send_cis_message'], 'string'],
            [['send_cis_status_id', 'id_cis'], 'integer'],
            [['contract_id'], 'string', 'max' => 30],
            [['sagr'], 'string', 'max' => 2],
            [['nagr'], 'string', 'max' => 7],
            [['contract_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'insert_date' => 'Дата создания записи',
            'contract_id' => 'ID договора',
            'sagr' => 'Серия договора',
            'nagr' => '№ договора',
            'data_json' => 'Данные JSON',
            'send_cis_date' => 'Дата успешной отправки в КИС',
            'send_cis_message' => 'Сообщение об отправке в КИС',
            'send_cis_status_id' => 'Статус отправки в КИС',
            'id_cis' => 'ID КИС',
        ];
    }

    /**
     * Получает документы из API источника
     *
     * @return void
     */
    public function contractGetter()
    {

    }

    /**
     * Подготавливает документы к отправке в API приемника.
     * В данном случае, получает по API КИС:
     * - Бланки
     * - Места регистрации
     *
     * @return void
     */
    public function contractPreSender()
    {

    }

    /**
     * Отправляет документы в API приемника
     *
     * @return void
     */
    public function contractSender()
    {

    }

}
