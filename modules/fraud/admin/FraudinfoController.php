<?php

namespace app\modules\fraud\admin;

use Yii;
use app\modules\fraud\models\Fraudinfo;
use app\modules\fraud\models\FraudMediumContent;
use app\modules\fraud\admin\search\FraudinfoSearch;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\includes\CommonUtility;

/**
 * FraudinfoController implements the CRUD actions for Fraudinfo model.
 */
class FraudinfoController extends Controller
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
     * Lists all Fraudinfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FraudinfoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }



    /**
     * Creates a new Fraudinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fraudinfo;

        if ($model->load(Yii::$app->request->post())) {
			$model->fraud_info_systime = date('Y-m-d H:m:s');
			$model->fraud_info_ip = CommonUtility::getIP();		
			if ($model->save()) {
				//获取介质分类
				$fm = CommonUtility::getDictsList('fraud_medium', 0);
				foreach ($fm as $key => $value) {
					if (isset($_POST['medium_content_'.$key])) {
						//循环空格隔开的内容
						if($_POST['medium_content_'.$key])
						
							$str = trim($_POST['medium_content_'.$key]);// 首先去掉头尾空格 
							$str = preg_replace('/\s(?=\s)/', '', $str);// 接着去掉两个空格以上的
							
							$r = explode(" ", $str);
							//多个介质
							for ($i = 0; $i < sizeof($r); $i++) {
								$mfc = new FraudMediumContent;
								//存储诈骗介质的值
								$mfc->fraud_info_id = $model->fraud_info_id;
								$mfc->fraud_medium = $key;
								$mfc->medium_content = $r[$i];
								$mfc->save();
							}
					}
				}
				return $this->redirect(['index']);
			}
		} else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Fraudinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		//var_dump(Yii::$app->request->post());die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
				if ($model->save()) {
						foreach ($_POST as $key => $value) {
								if(strpos($key,'edit_medium_content_') > -1)
								{
									$mfcid = str_replace('edit_medium_content_','',$key);
									
									$mfcmodel = FraudMediumContent::findOne($mfcid);
									//存储诈骗介质的值
									$mfcmodel->medium_content = $value;
									$mfcmodel->update();
								}	
						}
					return $this->redirect(['index']);
				}
           
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Fraudinfo model.
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
     * Finds the Fraudinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fraudinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fraudinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
