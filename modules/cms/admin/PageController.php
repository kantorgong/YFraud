<?php

namespace app\modules\cms\admin;

use Yii;
use app\common\models\Page;
use app\common\models\search\PageSearch;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\admin\base\BaseBackController;
use app\models\Tag;
use app\components\Common;
use yii\helpers\Json;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends BaseBackController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id=="createimgajax" || $action->id=="filemanager" || $action->id=="crop-ajax") {
            $this->enableCsrfValidation=false;
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'autocomplete' => [
                'class' => 'app\components\AutocompleteAction',
                'tableName' => Tag::tableName(),
                'field' => 'name'
            ]
        ];
    }


    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }





    public function actionCreateimgajax()
    {
        if(!empty($_FILES)){
            $imageType = array('.gif', '.jpg', '.jpeg', '.png');
            if (!in_array(strrchr(strtolower($_FILES['imgFile']['name']),'.'), $imageType)) {
                echo Json::encode(['error' => 1, 'message' => Yii::t('app', "that's not an image, only allow '.gif', '.jpg', '.jpeg', '.png'")]);
                Yii::$app->end();
            }
            $dir=BASE_PATH.'/upload/page/'.date('Ym').'/';
            if(!is_dir($dir)) {
                @mkdir(dirname($dir), 0777);
                @mkdir($dir, 0777);
                touch($dir.'/index.html');
            }
            $name=date('His').strtolower(Common::random(16)).strrchr($_FILES['imgFile']['name'],'.');
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            move_uploaded_file($tmp_name, $dir.$name);
            $url=Yii::$app->homeUrl.'upload/page/'.date('Ym').'/'.$name;
            $name=$_FILES['imgFile']['name'];
            $size=$_FILES['imgFile']['size'];
            echo Json::encode(['error' => 0, 'url' => $url]);
        } else {
            echo Json::encode(['error' => 1, 'message' => Yii::t('app', "upload error")]);
        }

        Yii::$app->end();
    }



    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
