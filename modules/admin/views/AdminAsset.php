<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\admin\views;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin/css/font-awesome.min.css',
        'admin/css/font.css',
        'admin/js/select2/select2.css',
        'admin/js/datetimepicker/bootstrap-datetimepicker.css',
        'admin/css/plugin.css',

        'admin/css/uploadify.css',

        //'static/ace/css/bootstrap.min.css',
        'static/ace/css/font-awesome.min.css',
        'static/ace/css/ace.min.css',
        'static/ace/css/ace-rtl.min.css',
        'static/ace/css/ace-skins.min.css',

        'admin/css/style.css',

    ];
    public $js = [
        //'admin/js/jquery.js',
        'admin/js/app.js',
        'admin/js/app.plugin.js',

        // 'admin/js/charts/sparkline/jquery.sparkline.min.js',
        // 'admin/js/charts/easypiechart/jquery.easy-pie-chart.js',
        'admin/js/select2/select2.min.js',
        'admin/js/datetimepicker/moment.min.js',
        'admin/js/datetimepicker/bootstrap-datetimepicker.js',
        // 'admin/js/fileinput.js',
        // 'admin/js/jquery.cxselect.min.js',
        'admin/js/jquery.form.min.js',
        //  'admin/js/holder.js'


        'static/ace/js/jquery.mobile.custom.min.js',
        'static/ace/js/ace-extra.min.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset'
    ];

    public  $jsOptions=[
        'position' => POS_HEAD,
    ];


}
