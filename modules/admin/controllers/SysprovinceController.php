<?php

namespace app\modules\admin\Controllers;

use Yii;
use yii\web\HttpException;
use app\components\db\ActiveRecord;
use yii\helpers\Html;
use app\modules\admin\base\BaseBackController;
use app\modules\admin\models\sysprovince;
use app\modules\admin\models\search\SysprovinceSearch;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SysprovinceController implements the CRUD actions for sysprovince model.
 */
class SysprovinceController extends BaseBackController
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
     * Lists all sysprovince models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SysprovinceSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }



    /**
     * Creates a new sysprovince model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new sysprovince;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing sysprovince model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing sysprovince model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the sysprovince model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return sysprovince the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = sysprovince::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	public static function actionGetCityByPid($fraud_info_provinceid) {
		$sp = new Sysprovince;
		if(!isset($fraud_info_provinceid))
			$fraud_info_provinceid=11;
		  $Citys = $sp::find()->select('codeid, parentid,cityname')
				  ->where('parentid='.$fraud_info_provinceid)
            ->orderBy('codeid ASC')
            ->asArray()
            ->all();
			$cityarr=array();
		if (isset($Citys)) {
			foreach ($Citys as $k => $v) {
				$cityarr[$v['codeid']] = $v['cityname'];
			}
		} else {
			$cityarr[0] = '';
		}
		return $cityarr;
		
//		if (isset($Citys)) {
//			foreach ($Citys as $k => $v) {
//				//foreach ($v as $kk => $vv) {
//				var_dump($v['cityname']);die;
//					echo Html::tag('option', array('value' => $v['codeid']), Html::encode($v['cityname']), true);
//				//}
//			}
//		} else {
//			echo Html::tag('option', array('value' => ''), 'servers', true);
//		}
	}
	
	public  function actionGetCityByPidAjax($fraud_info_provinceid) {
		    if(!Yii::$app->request->isAjax)
		      throw new HttpException(505,'错误');
		$sp = new Sysprovince;
		  $Citys = $sp::find()->select('codeid, parentid,cityname')
				  ->where('parentid='.$fraud_info_provinceid)
            ->orderBy('codeid ASC')
            ->asArray()
            ->all();
		  
//			$cityarr=array();
//		if (isset($Citys)) {
//			foreach ($Citys as $k => $v) {
//				$cityarr[$v['codeid']] = $v['cityname'];
//			}
//		} else {
//			$cityarr[0] = '';
//		}
//		return $cityarr;
		
		if (isset($Citys)) {
			foreach ($Citys as $k => $v) {
					echo Html::tag('option', array('value' => $v['codeid']), Html::encode($v['cityname']), true);
			}
		} else {
			echo Html::tag('option', array('value' => ''), 'servers', true);
		}
	}
	
}
