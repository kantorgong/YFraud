<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Role;
use app\modules\admin\models\Menu;
use app\modules\admin\models\RolePriv;
use app\modules\admin\models\search\RoleSearch;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;


/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param string $id
     * @return mixed
     */
    public function actionPriv($id)
    {
        $model = $this->findModel($id);
        if (\Yii::$app->request->isAjax) {
            RolePriv::deleteAll('role_id=:id', ['id' => $id]);
            try {
                foreach (\Yii::$app->request->post('menu_id') as $menuId) {
                    RolePriv::getDb()->createCommand()->insert('admin_role_priv', [
                        'menu_id' => $menuId,
                        'role_id' => $id
                    ])->execute();
                }
                $model->delCache();
                $this->success('保存成功！');
            } catch (Exception $exc){
                $this->error('保存失败!');
            }
        }
        $privs = $model->getMenu();
        $rs = Menu::find()->select('id,parentid as pId, name')->orderBy('listorder DESC')->asArray()->all();
        $menus = [];
        foreach ($rs as $menu) {
            $menus[$menu['id']] = $menu;
            if (isset($privs[$menu['id']])) {
                $menus[$menu['id']]['checked'] = true;
                $menus[$menu['id']]['open'] = true;
            }
        }

        $menus = array_values($menus);
        return $this->render('priv', [
            'model' => $model,
            'menus' => $menus,
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role;
        $model->attributes = $model->getAttributeDefaults();
        $this->performAjaxValidation($model);
        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->performAjaxValidation($model);
        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id !== null && ($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Job $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {

        if ($model->load($_POST) && Yii::$app->request->isAjax && Yii::$app->request->post('ajax') == 'role-form') {
            Yii::$app->response->format = Response::FORMAT_JSON;

            Yii::$app->response->data = \yii\widgets\ActiveForm::validate($model);
            Yii::$app->response->send();
            exit;
        }
    }
}
