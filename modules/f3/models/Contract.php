<?php

namespace app\modules\f3\models;

use app\common\models\SendCis;
use app\models\SendCisStatus;
use app\modules\f3\components\Cis;
use app\modules\f3\components\Busfor;
use app\modules\f3\helpers\Map;
use Yii;

/**
 * This is the model class for table "f2_contract".
 *
 * @property int $id
 * @property string $insert_date Дата создания записи
 * @property string $contract_id ID договора
 * @property string $insurance_state Состояние договора
 * @property string $data_json Данные JSON
 * @property string $send_cis_date Дата успешной отправки в КИС
 * @property string $send_cis_message Сообщение об отправке в КИС
 * @property int $send_cis_status_id Статус отправки в КИС
 * @property int $send_cis_id_cis ID КИС
 */
class Contract extends SendCis
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%f3_contract}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_id'], 'unique'],
            [['contract_id', 'insurance_state'], 'trim'],
            [['insert_date',
                'contract_id',
                'insurance_state',
                'data_json',
                'send_cis_date',
                'send_cis_message',
                'send_cis_status_id',
                'send_cis_id_cis'], 'safe'],

        ];
    }

    /**
     * Получает документы из API источника
     *
     * @return void
     */
    public function contractGetter()
    {

        $pb = new Busfor();
        //$data = $pb->contractGetter(date('Y-m-d', strtotime('-' . \Yii::$app->params['e']['f3']['report_days'] . ' day')), date('Y-m-d'));
        $data = $pb->contractGetter('2018-05-15', '2018-05-22');  //FIXME: Только для разработки!!!
        foreach ($data as $item) {

            $this->contractInsert($item);

        }

    }



    /**
     * Отправляет документы в API приемника (CIS)
     * FIXME: Метод в разработке!!!
     *
     * @return void
     */
    public function contractSender()
    {
        
        //$data = Self::find()->asArray()->where(['in', 'send_cis_status_id',  [SendCisStatus::STATUS_DAFAULT, SendCisStatus::STATUS_ERROR]])->andWhere("insurance_state = 'confirmed'")->all(); //Только новые и ошибки (0, 800)
        $data = Self::find()->asArray()->where("send_cis_status_id in (0, 800) and id in (20, 21, 22, 23,25, 27, 31, 28) and insurance_state = 'confirmed'")->all(); //FIXME: Для разработки!!!
        if (!empty($data)) {
            $cis = new Cis();
            foreach ($data as $item) {
                
                $data = $cis->contractSender($item);


                $this->updateStatus($item['id'], 0, json_encode($data, JSON_UNESCAPED_UNICODE));
               
                // if (isset($data['id_contract']) && isset($data['sign'])) { //Договор сохранился в КИС
                //     if ($data['sign'] == true) { //Договор подписан
                //         $this->updateStatus($item['id'], SendCisStatus::STATUS_SEND, 'OK', $data['id_contract']);
                //     } else { //Договор не подписан
                //         $this->updateStatus($item['id'], SendCisStatus::STATUS_SEND_NO_SIGN, $data['message'], /*json_encode($data, JSON_UNESCAPED_UNICODE)*/ $data['id_contract']);
                //     }
                // } else if (strpos($data['message'], 'Дублирование регистрационного номера') != false) { //Дубликат
                //     $this->updateStatus($item['id'], SendCisStatus::STATUS_DUPLICATE, 'Дубликат');
                // } else { //Все остальные ошибки и непонятки
                //     $this->updateStatus($item['id'], SendCisStatus::STATUS_ERROR, json_encode($data, JSON_UNESCAPED_UNICODE));
                // }


            }
            return $data;
        }
    }



    /**
     * Добавление договора в таблицу.

     * @param $data
     * @return void
     */
    private function contractInsert($data)
    {

        $model = Self::findOne(['contract_id' => $data['id']]);

        if (!$model) {

            $contract = new Contract();
            $contract->contract_id = $data['id'];
            $contract->insurance_state = $data['insurance_state'];
            $contract->data_json = json_encode($data, JSON_UNESCAPED_UNICODE);
            $contract->save();

        }

    }

}
