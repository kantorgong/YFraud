<?php

namespace app\controllers;

use Yii;
use app\common\models\Page;
use app\common\models\search\PageSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * PageController implements the CRUD actions for Post model.
 */
class PageController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'error',],
                        'allow' => true,
                    ],
                    
                ],
            ],
        ];
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($name)
    {
        $pages=Page::find()->all();
        foreach($pages as $key=>$value)
        {
            $menuItems[] = ['label' => $value->title, 'url' => ['page/view', 'name' => $value->name]];
        }
        return $this->render('view', [
            'model' => $this->findModel($name),
            'pages' => $pages,
            'menuItems' =>$menuItems
        ]);
    }

    protected function findModel($name)
    {
        if (($model = Page::findOne(['name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
