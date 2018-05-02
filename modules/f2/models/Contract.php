<?php

namespace app\modules\f2\models;

use app\models\SendCisStatus;
use app\modules\f2\components\Cis;
use app\modules\f2\components\PB;
use Yii;
use app\modules\f2\helpers\Map;

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
            [['contract_id'], 'unique'],
            [['contract_id', 'sagr', 'nagr'], 'trim'],
            [['insert_date',
                'contract_id',
                'sagr',
                'nagr',
                'data_json',
                'id_blank',
                'id_place',
                'send_cis_date',
                'send_cis_message',
                'send_cis_status_id',
                'id_cis'], 'safe'],

         ];
    }

    /**
     * Получает документы из API источника
     *
     * @return void
     */
    public function contractGetter()
    {

        $pb = new PB();
        $data = $pb->contractGetter(date('Y-m-d', strtotime('-' . \Yii::$app->params['e']['f2']['report_days'] . ' day')), date('Y-m-d'));

        foreach ($data as $item) {

            $this->contractInsert($item);

        }

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
        $data = Self::find()->asArray()->where("send_cis_status_id = 0")->all();

        if (!empty($data)) {

            $cis = new Cis();

            foreach ($data as $item) {

                /**
                 * Ищем договор в буферной таблице
                 */
                $contract = Self::findOne($item['id']);

                /**
                 * Заполняем поля
                 */
                $contract->sagr = Map::blankSeries(trim($item['sagr'])); //Преобразованная серия полиса
                $contract->id_blank = $cis->idBlankGetter(Map::blankSeries(trim($item['sagr'])), trim($item['nagr']));
                $contract->id_place = $cis->idPlaceGetter(json_decode($item['data_json'])->c_city);

                /**
                 * Готовим сообщение
                 * TODO: Стоит подумать про отдельный метод для этого
                 */
                $send_cis_message = [];
                if ($contract->id_blank === null) {
                    array_push($send_cis_message, 'Не найден бланк (возможно, серия на латинице)');
                }
                if ($contract->id_place === null) {
                    array_push($send_cis_message, 'Не найдено место регистрации');
                }
                $contract->send_cis_message = implode('; ', $send_cis_message);

                /**
                 * Устанавливаем статус send_cis_status_id
                 * TODO: Стоит подумать про отдельный метод для этого
                 */
                if ($contract->id_blank === null || $contract->id_place === null) {
                    $contract->send_cis_status_id = SendCisStatus::STATUS_ERROR_PRESENDER; //Ошибка Пресендера
                } else {
                    $contract->send_cis_status_id = SendCisStatus::STATUS_PROCESSED_PRESENDER; //Обработан ПреСендером
                }

                $contract->update();

            }
        }
    }

    /**
     * Отправляет документы в API приемника
     *
     * @return void
     */
    public function contractSender()
    {
        //$data = Self::find()->asArray()->where("send_cis_status_id = 300")->all(); //Только те, что обработал ПреЛоадер
        $data = Self::find()->asArray()->where("send_cis_status_id = 300 and id in (161)")->all(); //FIXME: Для разработки!!!

        if (!empty($data)) {

            $cis = new Cis();
            foreach ($data as $item) {

                $a = $cis->contractSender($item);
                //$a = json_decode($item['data_json']);
                
                

            }


            return $a;

        }

    }

    /**
     * Добавление договора в таблицу.

     * @param $data
     * @return void
     */
    private function contractInsert($data)
    {

        $model = Self::findOne(['contract_id' => $data['contractId']]);

        if (!$model) {
            $contract = new Contract();
            $contract->contract_id = $data['contractId'];
            $contract->sagr = $data['sagr'];
            $contract->nagr = $data['nagr'];
            $contract->data_json = json_encode($data, JSON_UNESCAPED_UNICODE);
            $contract->save();
        }

    }

}
