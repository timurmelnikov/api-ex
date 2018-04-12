<?php

namespace app\modules\f1\models;

use Yii;

/**
 * This is the model class for table "f1_claim".
 *
 * @property int $id
 * @property string $reg_date Дата регистрации в ПБ
 * @property string $doc_type Тип договора ПБ
 * @property string $doc_num_pb № договора ПБ
 * @property string $claim_id_pb ID заявки ПБ
 * @property string $claim_data Данные заявки
 * @property int $current_status Текущий статус заявки ПБ
 * @property string $insert_date Дата вставки в буфер
 * @property string $change_date Дата изменения
 * @property int $loss_id_cis ID убытка КИС
 *
 * @property F1ClaimMove[] $f1ClaimMoves
 */
class Claim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f1_claim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_date', 'doc_type', 'doc_num_pb', 'claim_id_pb', 'claim_data', 'current_status'], 'required'],
            [['reg_date', 'insert_date', 'change_date'], 'safe'],
            [['claim_data'], 'string'],
            [['current_status', 'loss_id_cis'], 'integer'],
            [['doc_type'], 'string', 'max' => 5],
            [['doc_num_pb', 'claim_id_pb'], 'string', 'max' => 20],
            [['doc_type', 'doc_num_pb', 'claim_id_pb'], 'unique', 'targetAttribute' => ['doc_type', 'doc_num_pb', 'claim_id_pb']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reg_date' => 'Регистрация в ПБ',
            'doc_type' => 'Тип договора',
            'doc_num_pb' => '№ договора',
            'claim_id_pb' => 'ID заявки ПБ',
            'claim_data' => 'Данные заявки',
            'current_status' => 'Текущий статус',
            'insert_date' => 'Дата вставки в буфер',
            'change_date' => 'Дата изменения',
            'loss_id_cis' => 'ID убытка КИС',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getF1ClaimMoves()
    {
        return $this->hasMany(F1ClaimMove::className(), ['claim_id' => 'id']);
    }
}
