<?php

namespace app\common;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;


/**
 * Базовый контроллер приложения
 * От него наследуются все контроллеры
 * @author Timur Melnikov <melnikovt@gmail.com>
 */
class Controller extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['about','contact', 'index', 'login', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
           
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

}
