<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/front/css/common/global.css',
        'static/front/css/common/totop.css',
        'static/front/css/lanhuwei/index.css',
    ];
    public $js = [
       // 'static/front/js/common/jquery-1.9.1.min.js',
        'static/front/js/common/lanhuwei.js',
        'static/front/js/common/totop.js',

//        'static/front/js/lanhuwei/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
