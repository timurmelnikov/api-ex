<?php

namespace app\modules\f4\models;

use app\common\models\SendCis;
use app\models\SendCisStatus;
use app\modules\f4\components\Cis;
use app\modules\f4\components\Siesta;
use Yii;

/**
 * This is the model class for table "f2_contract".
 *
 * @property int $id
 * @property string $insert_date Дата создания записи
 * @property string $policy_no № договора
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
        return '{{%f4_contract}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['policy_no'], 'trim'],
            [['insert_date',
                'policy_no',
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

        $pb = new Siesta();
        $data = $pb->contractGetter(date('Ymd', strtotime('-' . \Yii::$app->params['e']['f4']['report_days'] . ' day')), date('Ymd', strtotime('+1 day')));
        foreach ($data['Policy'] as $item) {
            $this->contractInsert($item);
        }

    }

    /**
     * Отправляет документы в API приемника (CIS)
     *
     * @return void
     */
    public function contractSender()
    {

        $data = Self::find()
            ->asArray()
            ->where(['in', 'send_cis_status_id', [SendCisStatus::STATUS_DAFAULT, SendCisStatus::STATUS_ERROR]]) //Только новые и ошибки (0, 800)
        //  ->andWhere(['in', 'policy_no', ['21856', '21850']]) 
            ->all();

        if (!empty($data)) {
            $cis = new Cis();
            foreach ($data as $item) {

                $data = $cis->contractSearchByNumber(Cis::NUM_PREFIX . $item['policy_no']);
                if ($data['success'] == true) {
                    if ($data['id_doc'] == null) {
                        //Дубликат договора не найден

                        $data = $cis->contractSender($item);

                        //Если КИС, вернул $data['id_contract', создаем договор
                        if (isset($data['id_contract'])) {
                            if ($data['sign'] == true) {
                                $this->updateStatus($item['id'], SendCisStatus::STATUS_SEND, json_encode($data, JSON_UNESCAPED_UNICODE), $data['id_contract']); //Отправлен 100
                            }
                            if ($data['sign'] == false) {
                                $this->updateStatus($item['id'], SendCisStatus::STATUS_SEND_NO_SIGN, json_encode($data, JSON_UNESCAPED_UNICODE), $data['id_contract']); //Не подписан 101
                            }
                        } else { //Пишем сообщение об ошибке
                            $this->updateStatus($item['id'], SendCisStatus::STATUS_ERROR, json_encode($data, JSON_UNESCAPED_UNICODE)); //Ошибка 800
                        }
                    } else {
                        //Дубликат
                        $this->updateStatus($item['id'], SendCisStatus::STATUS_DUPLICATE, 'Дубликат', $data['id_doc']); //Дубликат 201
                    }
                } else {
                    //В этом случае - не понятно есть договор в КИС или нет
                    $this->updateStatus($item['id'], SendCisStatus::STATUS_DAFAULT, 'Не понятно, существует договор в КИС, или нет?'); //Не понятно, что произошло, оставляем статус 0
                }
            }
            // return $data;
        }
    }

    /**
     * Добавление договора в таблицу.

     * @param $data
     * @return void
     */
    private function contractInsert($data)
    {

        $model = Self::findOne(['policy_no' => $data['PolicyNo']]);

        if (!$model) {

            $contract = new Contract();
            $contract->policy_no = $data['PolicyNo'];

            $contract->data_json = json_encode($data, JSON_UNESCAPED_UNICODE);
            $contract->save();

        }

    }

}
