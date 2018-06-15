<?php

namespace app\modules\f3\models;

use app\common\models\SendCis;
use app\models\SendCisStatus;
use app\modules\f3\components\Busfor;
use app\modules\f3\components\Cis;
use Yii;

/**
 * This is the model class for table "f2_contract".
 *
 * @property int $id
 * @property string $insert_date Дата создания записи
 * @property string $product Продукт
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
            //[['contract_id', 'product', 'insurance_state'], 'unique'],
            [['contract_id', 'product', 'insurance_state'], 'trim'],
            [['insert_date',
                'contract_id',
                'product',
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
        $data = $pb->contractGetter(date('Y-m-d', strtotime('-' . \Yii::$app->params['e']['f3']['report_days'] . ' day')), date('Y-m-d', strtotime('+1 day')));
        foreach ($data as $item) {
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
        //->andWhere(['in', 'contract_id', ['busforua-38529543-1', 'busforua-22028255-1', 'busforua-82347143-1']])
            ->all();

        if (!empty($data)) {
            $cis = new Cis();
            foreach ($data as $item) {

                $data = $cis->contractSearchByNumber($item['contract_id']);
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
     * Удалаяет документы в API приемника (CIS)
     * Удаляет договоры со статусом "returned"
     *
     * @return void
     */
    public function contractRemover()
    {

        $data = Self::find()
            ->asArray()
            ->where(['in', 'send_cis_status_id', [SendCisStatus::STATUS_DAFAULT, SendCisStatus::STATUS_ERROR]]) //Только новые и ошибки (0, 800)
            ->andWhere(['insurance_state' => 'returned'])
            ->all();

        if (!empty($data)) {
            $cis = new Cis();
            foreach ($data as $item) {

                $data = $cis->contractRemove($item['contract_id']);
                //Если КИС, вернул $data['id_contract', создаем договор
                if (isset($data[0]['success'])) {
                    if ($data[0]['success'] == true) {
                        $this->updateStatus($item['id'], SendCisStatus::STATUS_DELETED, json_encode($data, JSON_UNESCAPED_UNICODE)); //Отправлен 102
                    }
                    if ($data[0]['success'] == false) {
                        $this->updateStatus($item['id'], SendCisStatus::STATUS_ABSENT, json_encode($data, JSON_UNESCAPED_UNICODE)); //Не подписан 202
                    }
                } else { //Пишем сообщение об ошибке
                    $this->updateStatus($item['id'], SendCisStatus::STATUS_ERROR, json_encode($data, JSON_UNESCAPED_UNICODE)); //Ошибка 800
                }

                // return $data;
            }

        }
        // return $data;
    }

    /**
     * Добавление договора в таблицу.

     * @param $data
     * @return void
     */
    private function contractInsert($data)
    {

        $model = Self::findOne(['contract_id' => $data['id'], 'insurance_state' => $data['insurance_state'], 'product' => $data['product']]);

        if (!$model) {

            $contract = new Contract();
            $contract->contract_id = $data['id'];
            $contract->product = $data['product'];
            $contract->insurance_state = $data['insurance_state'];
            $contract->data_json = json_encode($data, JSON_UNESCAPED_UNICODE);
            $contract->save();

        }

    }

}
