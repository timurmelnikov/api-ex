<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
            <title>
                <?= Html::encode($this->title) ?>
            </title>
            <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name. ' ('.Yii::$app->params['use_config'].')',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index'], 'visible' => !Yii::$app->user->isGuest,],



            ['label' => 'Вызовы API',
            'items' => [

                ['label' => 'Сообщения (e-mail)', 'url' => ['/message']],
                '<li class="divider"></li>',
                ['label' => 'Поток 1 (ПриватБанк)', 'url' => ['/f1']],
                ['label' => 'Поток 2 (ПриватБанк ОСАГО)', 'url' => ['/f2']],
                ['label' => 'Поток 3 (Busfor)', 'url' => ['/f3']],
                ['label' => 'Поток 4 (Сиеста)', 'url' => ['/f4']],

            ],
            'visible' => !Yii::$app->user->isGuest,
            ],


            ['label' => 'Обработчики заявок',
            'items' => [

                ['label' => 'Поток 1 (ПриватБанк)', 'url' => ['/f1/claim']],
                //'<li class="divider"></li>',
                //['label' => 'Поток 2 (ПриватБанк ОСАГО)', 'url' => ['/f2']],

            ],
            'visible' => !Yii::$app->user->isGuest,
            ],

            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

                <div class="container">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                        <?= Alert::widget() ?>



                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (\Yii::$app->params['use_config'] == 'go!'): ?>
                                    <div class="alert alert-danger alert-slim" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Внимание!!!: </strong> Используются <strong>боевые</strong> настройки ($use_config = 'go!').
                                    </div>
                                    <?php endIf; ?>
                                </div>

                            </div>

                            <?= $content ?>
                </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Timur Melnikov
                    <?= date('Y') ?>
                </p>

                <p class="pull-right">
                    <?= Yii::powered() ?>
                </p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>

    </html>
    <?php $this->endPage() ?>