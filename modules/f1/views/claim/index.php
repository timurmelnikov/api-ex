<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\f1\models\ClaimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Claims';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['timeout'=>3000]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Claim', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'reg_date',
            'doc_type',
            'doc_num_pb',
            'claim_id_pb',
            //'claim_data:ntext',
            'current_status',
            'insert_date',
            'change_date',
            'loss_id_cis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
