<?php

namespace app\modules\admin\controllers;

use app\components\helper\Tree;
use Yii;
use app\modules\admin\models\Linkage;
use app\modules\admin\models\search\LinkageSearch;
use app\modules\admin\components\Controller;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LinkageController implements the CRUD actions for Linkage model.
 */
class LinkageController extends Controller
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

    /**
     * Lists all Linkage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LinkageSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    /**
     * Creates a new Linkage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Linkage;
        $model->attributes = $model->getAttributeDefaults();
        $model->keyid = Yii::$app->request->get('keyid', 0);
        $model->parentid = Yii::$app->request->get('parentid', 0);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'LinkageSearch' => ['keyid' => $model->keyid, 'parentid' => $model->parentid]]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Linkage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'LinkageSearch' => ['keyid' => $model->keyid, 'parentid' => $model->parentid]]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Linkage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Linkage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Linkage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Linkage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCache($id)
    {

        if(Linkage::cache($id) === false)
            throw new NotFoundHttpException('The requested page does not exist.');

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSelectlink($id)
    {
        $rs = Yii::$app->cache->get('linkage_'. $id);

        if (!$rs) throw new NotFoundHttpException('The requested page does not exist.');
        $tmprs = [];
        foreach($rs as $k=>$v) {
            $tmprs[$v['id']] = [
                'id' => $v['id'],
                'v' => $v['id'],
                'n' => $v['name'],
                'parentid' => $v['parentid']
            ];
        }
       Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return (Tree::getInstance()->setData($tmprs)->getTree(0,0,false,'s'));
    }
}
