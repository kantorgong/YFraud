<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-4
 * Time: 上午3:19
 */

namespace app\components\helper;

use Ssh\Authentication\Password;
use Ssh\Session;
use Yii;
use Ssh\Configuration;

class Sshell
{

    public static function RestRadius()
    {

        $configuration = new Configuration(Yii::$app->params['sshell']['host']);
        $authentication = new Password(Yii::$app->params['sshell']['username'], Yii::$app->params['sshell']['password']);
        $session = new Session($configuration, $authentication);
        $session->getExec()->run('service freeradius restart');
    }
} 