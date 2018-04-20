<?php

namespace app\modules\f2\components;

class Cis extends \app\common\components\Cis
{

    public function idBlankGetter(){
       $data = $this->cisRequest('cis/utils/blanks_by_series_number', ['series'=>'АК', 'number'=>'8131803']);


       return $data;
    }

    public function idBlancGetter(){

    }

}
