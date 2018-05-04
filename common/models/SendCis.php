<?php

namespace app\common\models;

use app\modules\f2\components\Cis;
use Yii;

/**
 * Глобальная модель для отправки документов в КИС
 *
 * @property string $send_cis_date Дата успешной отправки в КИС
 * @property string $send_cis_message Сообщение об отправке в КИС
 * @property int $send_cis_status_id Статус отправки в КИС
 * @property int $send_cis_id_cis ID КИС
 */
class SendCis extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
         
            [[

                'send_cis_date',
                'send_cis_message',
                'send_cis_status_id',
                'send_cis_id_cis'], 'safe'],

        ];
    }

    /**
     * Обновляет служебные поля:
     * send_cis_date Дата успешной отправки в КИС
     * send_cis_status_id Статус отправки в КИС
     * send_cis_message Сообщение об отправке в КИС
     * send_cis_id_cis ID КИС
     *
     * @param int $id ID обновляемого документа
     * @param int $status_id ID статусов отправки в КИС из модели SendCisStatus
     * @param string $message Сообщение (ответ, текст об ошибке)
     * @param int $id_cis ID КИС
     *
     * @return void
     */
    protected function updateStatus($id, $status_id, $message = '', $id_cis = null)
    {
        $document = Self::findOne($id);
        $document->send_cis_date = date('Y-m-d H:i:s', time());
        $document->send_cis_status_id = $status_id;
        $document->send_cis_message = $message; //json_encode($message, JSON_UNESCAPED_UNICODE); //Преобразованная серия полиса
        $document->send_cis_id_cis = $id_cis;
        $document->update();

    }

}
