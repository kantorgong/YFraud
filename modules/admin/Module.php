<?php

namespace app\modules\admin;

use app\modules\admin\components\User;
use Yii;
use yii\helpers\FileHelper;
use yii\web\HttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $superUserIds = [];


    /**
     * 不需要登陆的页面
     * @var array
     */
    private $guestPages = [
        'default/login',
        'default/logout',
        'default/error',
        'linkage/selectlink'
    ];

    /**
     * 公用页面
     * @param \yii\base\Action $action
     * @return bool
     */
    private $publicPages = [
        'default/index',
        'default/main'
    ];

    /**
     * 公用控制器
     * @var array
     */
    private $publicControllers = [
        'my'
    ];

    public function init()
    {
        parent::init();

        $components = array(
            'user' => array(
                'class' => 'app\modules\admin\components\User',
                'enableAutoLogin' => true,
                'identityCookie' =>[
                    'name' => '_backendUser',
                    'path' => '/advanced/backend',
                ]
            ),


            'admincache' => array(
                'class' => '\yii\caching\FileCache',
                'cachePath' => Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . 'admincache'
            )
        );
        Yii::$app->set('user',null);
        Yii::$app->setComponents($components);

        Yii::$app->errorHandler->errorAction = 'admin/default/error';

        $this->controllerMap = $this->getAdminControllerMap();
//        print_r($this->controllerMap);
//        exit;
        // custom initialization code goes here
    }

    /**
     * 获取控制器地图
     */
    private function getAdminControllerMap()
    {
        $cacheId = 'admin/controller/map';
        if (!YII_ENV_DEV && ($cache = self::getCache()->get($cacheId)) !== false)
            return $cache;
        else
            self::getCache()->delete($cacheId);

        $controllerMap = [];
        foreach (Yii::$app->getModules() as $name => $module) {
            if ($name == 'admin') continue;
            $path = Yii::getAlias('@app/modules/' . $name . '/admin');

            if (!file_exists($path))
                continue;
            $controllers = FileHelper::findFiles($path, ['only' => ['/*Controller.php']]);
            foreach ($controllers as $file) {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $controllerName = strtolower(substr($fileName, 0, -10));
                $controllerMap[$name . '_' . $controllerName] = [
                    'class' => 'app\\modules\\' . $name . '\\admin\\' . $fileName,
                    'ViewPath' => $path . '/views/' . $controllerName
                ];
            }
        }
        if (!YII_ENV_DEV)
            self::getCache()->set($cacheId, $controllerMap);
        return $controllerMap;
    }


    /**
     * 动作前置操作
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {


        if (!parent::beforeAction($action)) return false;
        if(($sid = YII::$app->request->post('_sessionid',null))) {
            Yii::$app->session->setId($sid);
            Yii::$app->controller->enableCsrfValidation = false;
        }
        $route = Yii::$app->controller->id . '/' . $action->id;
        if (in_array($route, $this->guestPages)) {
            return true;
        }

        if (\Yii::$app->user->isGuest) {
            \Yii::$app->user->loginRequired();
        } else {
            if (in_array(\Yii::$app->user->id, $this->superUserIds)) {

                return true;
            }
        }

        if (in_array($route, $this->publicPages)) {
            return true;
        }

        if (in_array(Yii::$app->controller->id, $this->publicControllers))
            return TRUE;


        if (User::getUser()->checkAccess($route)) {
            return true;
        } else {
            if (Yii::$app->request->isAjax) {
                $result = array();
                $result['status'] = 0;
                $result['info'] = "您没有被请求资源的访问权限。";
                $result['data'] = null;
                header('Content-Type:text/html; charset=utf-8');
                echo json_encode($result);
                exit;
            } else {
                throw new HttpException(505, "您没有被请求资源的访问权限。");
            }
        }

        return false;
    }

    /**
     * 返回后台缓存组件
     * @return \yii\caching\FileCache
     */
    public static function getCache()
    {
        return Yii::$app->admincache;
    }
}
