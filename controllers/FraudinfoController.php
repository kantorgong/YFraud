<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;
use app\modules\fraud\models\Fraudinfo;
use app\modules\fraud\models\FraudMediumContent;
use app\common\includes\CommonUtility;
use yii\web\UploadedFile;
use app\components\Common;
use yii\data\ActiveDataProvider;



class FraudinfoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'search', 'report', 'createimgajax'],
                        'allow' => true,
                    ],
//                    [
//                        'actions' => ['report','createimgajax'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
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
                'field' => 'name'
            ]
        ];
    }



//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }

    public function actionIndex()
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $query = Fraudinfo::find()->where(['fraud_info_status' => 0]);
        $fraud_type = "";
        if (isset($queryParams['id']))
        {
            $fraud_type = CommonUtility::getDict('fraud_type', $queryParams['id']);
            $query = $query->andWhere(['fraud_type_id' => $queryParams['id']]);
        }
//        if (isset($queryParams['tag'])) {
//            $query = $query->andWhere(['like', 'tags', $queryParams['tag']]);
//        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' =>
                ['fraud_info_systime' => SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'fraud_type' => $fraud_type
        ]);
    }

    //搜索
    public function actionSearch()
    {
        $queryParams = Yii::$app->request->getQueryParams();

        $query = new \yii\db\Query();
//        if (isset($_POST['medium_content']))
//        {
            $query->select(['*'])
                ->from('fraud_info')
                ->leftJoin('fraud_medium_content', 'fraud_info.fraud_info_id = fraud_medium_content.fraud_info_id')
                ->where("medium_content = '".$_POST['medium_content']."'")
                ->orderBy('fraud_info.fraud_info_systime desc')
                ->all();
            ;
        //}



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort' => ['defaultOrder' =>
//                ['fraud_info.fraud_info_id' => 'desc']
//            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $fraud_type = array();
        if (isset($model->fraud_type))
        {
            $fraud_type = CommonUtility::getDict('fraud_type', $fraud_type);
        }
        $model->updateCounters(['fraud_info_views' => 1]);
        return $this->render('view', [
            'model' => $model,
            'fraud_type' =>$fraud_type,
        ]);
    }


    public function actionReport()
    {
        $model = new Fraudinfo();
        $fraud_doc_name = '';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($_FILES['Fraudinfo']['size']['fraud_info_doc'] > 0) {
//                //上传附件 开始
//                $imageType = ['.gif', '.jpg', '.jpeg', '.png', '.doc', '.rar', '.zip'];
//                if (!in_array(strtolower(strrchr($_FILES['Fraudinfo']['name']['fraud_info_doc'], '.')), $imageType)) {
//                    Yii::$app->getSession()->setFlash('danger', '格式不支持.');
//                    return $this->redirect(['/fraudinfo/report']);
//                }
//                if ($_FILES['Fraudinfo']['size']['fraud_info_doc'] > 4 * 1024 * 1024) {
//                    Yii::$app->getSession()->setFlash('danger', '文件太大，请上传小于4M的文件.');
//                    return $this->redirect(['/fraudinfo/report']);
//                }
//                $fraud_dir = BASE_PATH . '/upload/fraud/' . date('Ym') . '/';
//                $fraud_doc = UploadedFile::getInstanceByName('Fraudinfo[fraud_info_doc]');
//                if (!is_dir($fraud_dir)) {
//                    @mkdir(dirname($fraud_dir), 0777);
//                    @mkdir($fraud_dir, 0777);
//                }
//                $new_fraud_doc_name = strtolower(Common::random(16)) . strrchr($_FILES['Fraudinfo']['name']['fraud_info_doc'], '.');
//                $fraud_doc_name = $fraud_dir . date('His') . $new_fraud_doc_name;//绝对路径
//                $status = $fraud_doc->saveAs($fraud_doc_name, true);
//
//                if (!$status) {
//                    Yii::$app->getSession()->setFlash('danger', '上传失败.');
//                }
//                else{
//                    $model->fraud_info_doc = '/upload/fraud/'  . date('Ym') . '/'. date('His') . $new_fraud_doc_name;//绝对路径
//                }
//                //上传附件 结束
//            }

            //获取正文第一张图片
            preg_match ("<img.*src=[\"](.*?)[\"].*?>",$model->fraud_info_content,$match);

            $model->fraud_info_doc = "$match[1]";

            $model->fraud_info_systime = date('Y-m-d,H:m:s');//系统时间
            $model->fraud_type_id = $_POST['fraudtype'];//诈骗类型
            $model->fraud_info_ip = Yii::$app->request->getUserIP();//ip地址
            $model->fraud_info_userid = Yii::$app->user->identity->id ? Yii::$app->user->identity->id : 1;
            $model->fraud_info_nickname = Yii::$app->user->identity->id ? Yii::$app->user->identity->username : 'robot';

            if ($model->save()) {
                //保存介质
                //获取介质分类
                $fm = CommonUtility::getDictsList('fraud_medium', 0);
                foreach ($fm as $key => $value) {
                    //var_dump($fm);die;
                    //var_dump($_POST['medium_content_67']);die;
                    if (isset($_POST['medium_content_' . $key])) {
//                        //循环空格隔开的内容
//                            $str = trim($_POST['medium_content_' . $key]);// 首先去掉头尾空格
//                            $str = preg_replace('/\s(?=\s)/', '', $str);// 接着去掉两个空格以上的
//                            $r = explode(" ", $str);
//                            //多个介质
                        $r = $_POST['medium_content_' . $key];
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
                Yii::$app->getSession()->setFlash('success', '保存成功.');
            } else {
                Yii::$app->getSession()->setFlash('danger', '保存失败.');
            }

            return $this->redirect(['/fraudinfo/report']);
        } else {
            return $this->render('report', [
                'model' => $model,
            ]);
        }
    }


    public function actionCreateimgajax()
    {
        if(!empty($_FILES)){
            $imageType = array('.gif', '.jpg', '.jpeg', '.png');
            if (!in_array(strrchr(strtolower($_FILES['imgFile']['name']),'.'), $imageType)) {
                echo Json::encode(['error' => 1, 'message' => Yii::t('app', "that's not an image, only allow '.gif', '.jpg', '.jpeg', '.png'")]);
                Yii::$app->end();
            }
            $dir=BASE_PATH.'/upload/fraud/'.date('Ym').'/';
            if(!is_dir($dir)) {
                @mkdir(dirname($dir), 0777);
                @mkdir($dir, 0777);
                touch($dir.'/index.html');
            }
            $name=date('His').strtolower(Common::random(16)).strrchr($_FILES['imgFile']['name'],'.');
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            move_uploaded_file($tmp_name, $dir.$name);
            $url=Yii::$app->homeUrl.'upload/fraud/'.date('Ym').'/'.$name;
            $name=$_FILES['imgFile']['name'];
            $size=$_FILES['imgFile']['size'];
            echo Json::encode(['error' => 0, 'url' => $url]);
        } else {
            echo Json::encode(['error' => 1, 'message' => Yii::t('app', "upload error")]);
        }

        Yii::$app->end();
    }


    protected function findModel($id)
    {
        if (($model = Fraudinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
