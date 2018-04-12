<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\f1\models\Claim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_date')->textInput() ?>

    <?= $form->field($model, 'doc_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_num_pb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'claim_id_pb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'claim_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'current_status')->textInput() ?>

    <?= $form->field($model, 'insert_date')->textInput() ?>

    <?= $form->field($model, 'change_date')->textInput() ?>

    <?= $form->field($model, 'loss_id_cis')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
