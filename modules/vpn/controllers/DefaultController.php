<?php

namespace app\modules\vpn\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
	public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]

        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
