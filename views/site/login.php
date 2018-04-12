<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>
    <div class="site-login">
        <?= Html::img( Yii::$app->request->baseUrl . '/img/logo-header.png') ?>

            <div class="well">

                <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4 col-md-4\">{input}</div>\n<div class=\"col-lg-4 col-md-4\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 col-md-4 control-label'],
        ],
    ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-4 col-md-offset-4 col-lg-4 col-md-4\">{input} {label}</div>\n<div class=\"col-lg-4 col-md-4\">{error}</div>",
        ]) ?>

                            <div class="form-group">
                                <div class="col-lg-offset-4 col-md-offset-4 col-lg-4 col-md-4">
                                    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                                </div>
                            </div>

                            <?php ActiveForm::end(); ?>
            </div>

    </div>