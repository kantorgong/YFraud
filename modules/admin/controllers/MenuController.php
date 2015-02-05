<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Menu;
use backend\models\MenuSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {

        $rs = Menu::find()->select('id, name,controller,action, parentid,listorder,icon,display')
            ->orderBy('listorder ASC')
            ->asArray()
            ->all();
        foreach ($rs as $k => $r) {
            if ($r['controller'] == '#') {

                $rs[$k]['links'] = '#';
            } else {
                $url = '/' . $r['controller'] . '/' . $r['action'];
                $rs[$k]['links'] = Url::to([$url], array($url));
            }
            $rs[$k]['display'] = ($r['display'])?'否':'是';
            $rs[$k]['str_manage'] = '
                <a style="padding:0px 2px;white-space:nowrap; " title="更新" href="' . Url::to(['update', 'id' => $r['id']]) . '"><span class="glyphicon glyphicon-pencil"></span> 修改</a>
                <a style="padding:0px 2px;white-space:nowrap; " data-method="post" data-confirm="确定要删除这条数据吗？" title="删除" href="' . Url::to(['delete', 'id' => $r['id']]) . '"><span class="glyphicon glyphicon-trash"></span> 删除</a>
			';
        }
        $str = "
			<tr>

				<td style='width: 60px'><input  name='listorders[\$id]' type='text' vid='\$id' size='3' style='margin-bottom:0;padding:0px; text-align: center' value='\$listorder' class='form-control listorders'></td></td>
				<td>\$spacer \$name </td>
				<td>\$display </td>
				<td>\$links</td>

				<td class='button-column'>
					\$str_manage
				</td>
			</tr>
		";
        $tree = \app\components\helper\Tree::getInstance();

        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $tree->setData($rs);

        return $this->render('index', array(
            'lists' => $tree->get_tree(0, $str)
        ));


    }

    /**
     * 排序
     */
    public function actionListorder() {

        $orders = \Yii::$app->request->post('listorders');

        foreach ($orders as $k => $v) {
            $model = Menu::findOne($k);
            $model->listorder = $v;
            $model->save();
            //Menu::model()->updateByPk($k, array('listorder' => $v));
        }
        $this->success('更新排序成功！');
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu;

        $model->attributes = $model->getAttributeDefaults();
        // $this->performAjaxValidation($model);
        if ($model->load($_POST) && $model->save()) {
            if (Yii::$app->request->post('crud', FALSE)) {
                foreach (array('create' => '创建', 'update' => '修改', 'delete' => '删除') as $k => $act) {
                    $data['controller'] = $model->controller;
                    $data['action'] = $k;
                    $data['name'] = $act;
                    $data['display'] = 1;
                    $data['parentid'] = $model->id;
                    $menuObj = new Menu;
                    $menuObj->attributes = $data;
                    $menuObj->save();
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $this->performAjaxValidation($model);

        if ($model->load($_POST) && $model->save()) {
            if (Yii::$app->request->post('crud', FALSE)) {
                foreach (array('create' => '创建', 'update' => '修改', 'delete' => '删除') as $k => $act) {
                    $data['controller'] = $model->controller;
                    $data['action'] = $k;
                    $data['name'] = $act;
                    $data['display'] = 1;
                    $data['parentid'] = $model->id;
                    $menuObj = new Menu;
                    $menuObj->attributes = $data;
                    $menuObj->save();
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        return $this->redirect(['index']);
        else
            throw new HttpException(505,'有子菜单不能删除！');
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id !== null && ($model = Menu::findOne($id)) !== null) {
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

        if ($model->load($_POST) && Yii::$app->request->isAjax && Yii::$app->request->post('ajax') == 'menu-form') {
            Yii::$app->response->format = Response::FORMAT_JSON;

            Yii::$app->response->data = \yii\widgets\ActiveForm::validate($model);
            Yii::$app->response->send();
            exit;
        }
    }
}
