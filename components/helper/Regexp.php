<?php
/**
 * 正则库
 * User: 吴涛
 * Date: 14-4-3
 * Time: 上午12:18
 */

namespace app\components\helper;


class Regexp {
    /**
     * 验证真实姓名
     */
    public static $realname = '/^[\x{4e00}-\x{9fa5}]+$/u';

    /**
     * 浮点数
     */
    public static $decmal = "/^([+-]?)\\d*\\.\\d+$/";

    /**
     * 正浮点数
     */
    public static $decmal1 = "/^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$/";

    /**
     * 负浮点数
     */
    public static $decmal2 = "/^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$/";

    /**
     * 浮点数
     */
    public static $decmal3 = "/^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$/";

    /**
     * 非负浮点数（正浮点数 + 0）
     */
    public static $decmal4 = "/^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$";

    /**
     * 非正浮点数（负浮点数 + 0）
     */
    public static $decmal5 = "/^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$/";

    /**
     * 整数
     */
    public static $intege = "/^-?[1-9]\\d*$/";

    /**
     * 正整数
     */
    public static $intege1 = "/^[1-9]\\d*$/";
    /*
     * 负整数
     */
    public static $intege2 = "/^-[1-9]\\d*$/";

    /**
     * 数字
     */
    public static $num = "/^([+-]?)\\d*\\.?\\d+$/";

    /**
     * 正数（正整数 + 0）
     */
    public static $num1 = "/^[1-9]\\d*|0$/";

    /**
     * 负数（负整数 + 0）
     */
    public static $num2 = "/^-[1-9]\\d*|0$/";

    /**
     * 仅ACSII字符
     */
    public static $ascii = "/^[\\x00-\\xFF]+$/";

    /**
     * 仅中文
     */
    public static $chinese = "/^[\\u4e00-\\u9fa5]+$/";

    /**
     * 颜色
     */
    public static $color = "/^[a-fA-F0-9]{6}$/";

    /**
     * 日期
     */
    public static $date = "/^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$/";

    /**
     * 邮件
     */
    public static $email = "/^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$/";

    /**
     * 身份证
     */
    public static $idcard = "/^[1-9]([0-9]{14}|[0-9]{17})$/";

    /**
     * ip地址
     */
    public static $ip4 = "/^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$/";

    /**
     * ip地址2
     */
    public static $ip41 = "/^((25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.){3}((25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)|((25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)-(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)))$/";

    /**
     * 字母
     */
    public static $letter = "/^[A-Za-z]+$/";

    /**
     * 小写字母
     */
    public static $letter_l = "/^[a-z]+$/";

    /**
     * 大写字母
     */
    public static $letter_u = "/^[A-Z]+$/";

    /**
     * 手机
     */
    public static $mobile = '/^(134|135|136|137|138|139|184|147|150|151|152|157|158|159|181|182|187|188|130|131|132|155|156|185|186|133|153|180|189)[0-9]{8}$/';

    /**
     * 电话号
     */
    public static $tel = "/(^(86)\-(0\d{2,3})\-(\d{7,8})\-(\d{1,4})$)|(^0(\d{2,3})\-(\d{7,8})$)|(^0(\d{2,3})\-(\d{7,8})\-(\d{1,4})$)|(^(86)\-(\d{3,4})\-(\d{7,8})$)/";

    /**
     * 非空
     */
    public static $notempty = "/^\\S+$/";

    /**
     * 字母数字下划线及-_
     */
    public static $string = "/^[A-Za-z0-9_-]+$/";

    /**
     * 图片
     */
    public static $picture = "(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$/";
    /*
     * QQ号码
     */
    public static $qq = "/^[1-9]*[1-9][0-9]*$/";

    /**
     * 压缩文件
     */
    public static $rar = "(.*)\\.(rar|zip|7zip|tgz)$/";

    /**
     * url
     */
    public static $url = "^http[s]? = \\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$/";

    /**
     * 用户名
     */
    public static $username = "/^[0-9a-zA-Z\x{4e00}-\x{9fa5}_]+$/u";

    /**
     * 邮编
     */
    public static $zipcode = "/^\\d{6}$/";

    /**
     * 正整数，以半角逗号分开
     */
    public static $stringdot = "/^\d+$|^\d+(?:,\d+)+$/";
} 