<?php

namespace app\modules\admin\controllers;
use app\modules\admin\models\Menu;
use Yii;
use app\modules\admin\components\Controller;
use app\modules\admin\form\LoginForm;
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

    public function actionMain() {
        return $this->render('main');
    }

    public function actionLogin() {

        if(!Yii::$app->user->isGuest)
            $this->redirect(['index']);
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $this->redirect(['index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout(false);
        return $this->goHome();
    }


}
