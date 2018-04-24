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

        /**
         * Преобразование серии с латиницы в кириллицу
         * TODO: Стоит подумать про отдельный метод для этого
         */
        if ($series == 'AK') {
            $series = 'АК';
        }

        $data = $this->cisRequest('cis/utils/blanks_by_series_number', ['series' => $series, 'number' => $number]);

        if (isset($data[0]['id_blank'])) {
            return $data[0]['id_blank'];
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

        $id_place = null;

        if (isset($data[0]['id_place'])) {
            $id_place = $data[0]['id_place'];
        } else {

            /**
             * В случае, если метод КИС "cis/utils/reg_place_by_id_mtsbu"
             * не нашел ничего, заполняем $id_place "вручную"
             * TODO: Стоит подумать про отдельный метод для этого
             */
            if ($id_place_mtsbu == 3345) {
                $id_place = 41949; //ТЗ зареестровані в iнших краiнах
            }
            if ($id_place_mtsbu == 3603) {
                $id_place = 33681; //Гадяч
            }

        }

        return $id_place;

    }

}
