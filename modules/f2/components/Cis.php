<?php

namespace app\modules\f2\components;

/*
 * Класс работы с КИС-WEB.
 * Прямой импорт ОСАГО.
 */
class Cis extends \app\common\components\Cis
{

    /**
     * Получает ID Бланка
     *
     * @return mixed
     */
    public function idBlankGetter($series, $number)
    {
        $data = $this->cisRequest('cis/utils/blanks_by_series_number', ['series' => $series, 'number' => $number]);

        if (isset($data[0]['id_blank'])) {
            return $data[0]['id_blank'];
        } else {
            return false;
        }
    }

    /**
     * Получает ID места регистрации
     *
     * @return mixed
     */
    public function idPlaceGetter($id_place_mtsbu)
    {
        $data = $this->cisRequest('cis/utils/reg_place_by_id_mtsbu', ['id_place_mtsbu' => $id_place_mtsbu]);

        if (isset($data[0]['id_place'])) {
            return $data[0]['id_place'];
        } else {
            return false;
        }

    }

}
