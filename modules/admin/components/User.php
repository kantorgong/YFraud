<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-6
 * Time: 下午6:07
 */

namespace app\modules\admin\components;

use app\modules\admin\models\Menu;
use Yii;

/**
 * Class User
 * @package app\modules\admin\components
 * @property \app\modules\admin\models\User $identity The identity object associated with the currently logged-in
 */
class User extends \yii\web\User
{
    /**
     * @var string the session variable name used to store the value of [[id]].
     */
    public $idParam = '__adminid';
    public $loginUrl = ['admin/default/login'];
    public $identityClass = 'app\modules\admin\models\User';

    /**
     * 获取菜单信息
     * @param string $type （m获取菜单 c获取菜单控制） 列表
     */
    public function getMenu()
    {

        if ($this->isSuperUser()) {
            $menu = Menu::find()->where('display=0')->orderBy('listorder ASC')->indexBy('id')->asArray()->all();

            return Menu::find()->where('display=0')->orderBy('listorder ASC')->indexBy('id')->asArray()->all();
        } else {
            return $this->identity->role->getMenu();
        }
    }

    public function getControllers()
    {
        return $this->identity->role->getControllers();
    }


    public function isSuperUser()
    {
        $module = Yii::$app->modules['admin'];
        if (is_object($module)) {
            $ids = $module->superUserIds;
        } else {
            $ids = $module['superUserIds'];
        }
        return in_array($this->id, $ids);
    }

    /**
     * 获取用户对象
     * @return User
     */
    public static function getUser()
    {
        return Yii::$app->getUser();
    }

    /**
     * @param string $operation
     * @return bool|void
     */
    public function checkAccess($operation, $params = [], $allowCaching = true)
    {

        return in_array($operation, $this->getControllers());
    }
} 