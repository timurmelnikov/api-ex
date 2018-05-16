<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message_type_id')->textInput() ?>

    <?= $form->field($model, 'message_status_id')->textInput() ?>

    <?= $form->field($model, 'message_status_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'send_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insert_date')->textInput() ?>

    <?= $form->field($model, 'send_after')->textInput() ?>

    <?= $form->field($model, 'send_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
