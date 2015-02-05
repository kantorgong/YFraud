<?php
/**
 * 工具类
 * User: 吴涛
 * Date: 14-5-19
 * Time: 下午3:32
 */

namespace app\components\helper;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Utils
{
    /**
     * 生成参数查询网址
     */
    public static function AttLink($text, $val = array(), $del = false, $selectClass = 'selected', $return = FALSE)
    {
        $get = isset($_GET) ? $_GET : array();

        $htmlOptions = array();
        $get = ArrayHelper::merge($get, $val);
        $get = self::arrayEmapy($get);
        array_unshift($get, '/'.Yii::$app->controller->route);

        $url = Url::to($get,true);

        $_url = strtr(Yii::$app->request->getAbsoluteUrl(),['/?'=>'?']);
        if (trim($_url,'/') == $url)
            $htmlOptions['class'] = $selectClass;

        if ($del != FALSE) {
            if (!is_array($del))
                $del = array($del);

            foreach ($del as $v) {
                unset($get[$v]);
            }

            $url = Url::to($get);
        }
        if ($return)
            return $url;
        return Html::a($text, $url, $htmlOptions);
    }

    /**
     * 清理空键
     * @param type $val
     * @return type
     */
    public static function arrayEmapy($val)
    {
        if (is_array($val)) {
            foreach ($val as $k => $v) {
                if (is_array($v)) {
                    $rv = self::arrayEmapy($v);
                    if (is_array($rv) && count($rv) > 0)
                        $val[$k] = self::arrayEmapy($v);
                    else
                        unset($val[$k]);
                }
                if ((is_null($v) || $v == '') && $v !== 0)
                    unset($val[$k]);
            }
        }
        return $val;
    }

} 