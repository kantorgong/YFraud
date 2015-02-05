<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use RouterOS\Core;
use Ssh\Authentication\Password;
use Ssh\Configuration;
use Ssh\Session;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        $configuration = new Configuration('192.168.2.23');
        $authentication = new Password('root', 'wt123asd');
        $session = new Session($configuration, $authentication);
        echo $session->getExec()->run('service freeradius restart');

        $api = new Core();
        $api->connect('192.168.2.21', 'admin', '');
        $api->debug = true;
        //$api->write('/ppp/active/print');


        $ARRAY = $api->comm("/ppp/active/print", array(
            ".proplist" => ".id"
        ));

        $ids = ArrayHelper::getColumn($ARRAY, '.id');

        $wutap = $api->comm('/ppp/active/remove ', ['numbers' => implode(',', $ids)]);


        $api->disconnect();

    }
}
