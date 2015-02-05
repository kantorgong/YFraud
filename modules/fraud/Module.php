<?php

namespace app\modules\fraud;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\fraud\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
	
	 private function getAdminControllerMap()
    {
        $cacheId = 'fraud/controller/map';
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
}
