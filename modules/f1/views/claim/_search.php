<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\f1\models\ClaimSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reg_date') ?>

    <?= $form->field($model, 'doc_type') ?>

    <?= $form->field($model, 'doc_num_pb') ?>

    <?= $form->field($model, 'claim_id_pb') ?>

    <?php // echo $form->field($model, 'claim_data') ?>

    <?php // echo $form->field($model, 'current_status') ?>

    <?php // echo $form->field($model, 'insert_date') ?>

    <?php // echo $form->field($model, 'change_date') ?>

    <?php // echo $form->field($model, 'loss_id_cis') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
