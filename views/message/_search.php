<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MessageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'message_type_id') ?>

    <?= $form->field($model, 'message_status_id') ?>

    <?= $form->field($model, 'message_status_text') ?>

    <?= $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'send_to') ?>

    <?php // echo $form->field($model, 'insert_date') ?>

    <?php // echo $form->field($model, 'send_after') ?>

    <?php // echo $form->field($model, 'send_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
