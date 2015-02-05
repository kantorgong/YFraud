<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-3
 * Time: 上午1:02
 */

namespace app\components\helper;


class StringHelper extends \yii\helpers\StringHelper {
    /**
     * 随即字符串
     * @param int $length 获取字符窜长度
     * @param string $numeric 字典
     * @return string
     */
    public  static  function random($length, $numeric = 0)
    {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if ($numeric) {
            $hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
            $max = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;

    }
} 