<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-5-20
 * Time: 下午10:36
 */

namespace app\components\helper;


use yii\helpers\BaseArrayHelper;

class ArrayHelper extends BaseArrayHelper
{
    public static function removeKey($array, $key)
    {
        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            unset($array[$key]);
        }
        return $array;
    }
} 