<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\widget\menu;

Yii::$app->controller->layout = false;
/**
 * @var yii\web\View $this
 */

\yii\bootstrap\BootstrapPluginAsset::register($this);
$this->title = '信息管理平台';
$this->beginPage();
?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--[if IE ]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->
        <meta charset="utf-8">
        <title><?= Html::encode($this->title) ?></title>

        <meta name="description" content="This is page-header (.page-header &gt; h1)">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php $this->head(); ?>

        <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/admin/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/admin/css/index.css">
        <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/ace/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/ace/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/ace/css/ace.min.css">
        <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/ace/css/ace-rtl.min.css">
        <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/ace/css/ace-skins.min.css">


    </head>

    <body style="min-width: 700px;" screen_capture_injected="true">
    <?php $this->beginBody(); ?>


    <div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="navbar-container" id="navbar-container">
    <div class="navbar-header pull-left">
        <a href="#" class="navbar-brand">
            <small>
                <i class="icon-leaf"></i>
                后台管理系统
            </small>
        </a><!-- /.brand -->
    </div>
    <!-- /.navbar-header -->

    <div class="navbar-header pull-right" role="navigation">
    <ul class="nav ace-nav">
    <li class="grey">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="icon-tasks"></i>
            <span class="badge badge-grey">4</span>
        </a>

        <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
            <li class="dropdown-header">
                <i class="icon-ok"></i>
                还有4个任务完成
            </li>

            <li>
                <a href="#">
                    <div class="clearfix">
                        <span class="pull-left">软件更新</span>
                        <span class="pull-right">65%</span>
                    </div>

                    <div class="progress progress-mini ">
                        <div style="width:65%" class="progress-bar "></div>
                    </div>
                </a>
            </li>

            <li>
                <a href="#">
                    <div class="clearfix">
                        <span class="pull-left">硬件更新</span>
                        <span class="pull-right">35%</span>
                    </div>

                    <div class="progress progress-mini ">
                        <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                    </div>
                </a>
            </li>

            <li>
                <a href="#">
                    <div class="clearfix">
                        <span class="pull-left">单元测试</span>
                        <span class="pull-right">15%</span>
                    </div>

                    <div class="progress progress-mini ">
                        <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                    </div>
                </a>
            </li>

            <li>
                <a href="#">
                    <div class="clearfix">
                        <span class="pull-left">错误修复</span>
                        <span class="pull-right">90%</span>
                    </div>

                    <div class="progress progress-mini progress-striped active">
                        <div style="width:90%" class="progress-bar progress-bar-success"></div>
                    </div>
                </a>
            </li>

            <li>
                <a href="#">
                    查看任务详情
                    <i class="icon-arrow-right"></i>
                </a>
            </li>
        </ul>
    </li>

    <li class="purple">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="icon-bell-alt icon-animated-bell"></i>
            <span class="badge badge-important">8</span>
        </a>

        <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
            <li class="dropdown-header">
                <i class="icon-warning-sign"></i>
                8条通知
            </li>

            <li>
                <a href="#">
                    <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												新闻评论
											</span>
                        <span class="pull-right badge badge-info">+12</span>
                    </div>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="btn btn-xs btn-primary icon-user"></i>
                    切换为编辑登录..
                </a>
            </li>

            <li>
                <a href="#">
                    <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												新订单
											</span>
                        <span class="pull-right badge badge-success">+8</span>
                    </div>
                </a>
            </li>

            <li>
                <a href="#">
                    <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												粉丝
											</span>
                        <span class="pull-right badge badge-info">+11</span>
                    </div>
                </a>
            </li>

            <li>
                <a href="#">
                    查看所有通知
                    <i class="icon-arrow-right"></i>
                </a>
            </li>
        </ul>
    </li>

    <li class="green">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="icon-envelope icon-animated-vertical"></i>
            <span class="badge badge-success">5</span>
        </a>

        <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
            <li class="dropdown-header">
                <i class="icon-envelope-alt"></i>
                5条消息
            </li>

            <li>
                <a href="#">
                    <img src="<?= Yii::getAlias('@web') ?>/static/ace/avatars/user.jpg" class="msg-photo"
                         alt="Alex's Avatar"/>
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Alex:</span>
												不知道写啥 ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>1分钟以前</span>
											</span>
										</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="<?= Yii::getAlias('@web') ?>/static/ace/avatars/user.jpg" class="msg-photo"
                         alt="Susan's Avatar"/>
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Susan:</span>
												不知道翻译...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>20分钟以前</span>
											</span>
										</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="<?= Yii::getAlias('@web') ?>/static/ace/avatars/user.jpg" class="msg-photo"
                         alt="Bob's Avatar"/>
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Bob:</span>
												到底是不是英文 ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>下午3:15</span>
											</span>
										</span>
                </a>
            </li>

            <li>
                <a href="inbox.html">
                    查看所有消息
                    <i class="icon-arrow-right"></i>
                </a>
            </li>
        </ul>
    </li>

    <li class="light-blue">
        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
            <img class="nav-user-photo" src="<?= Yii::getAlias('@web') ?>/static/ace/avatars/user.jpg" alt="头像"/>
								<span class="user-info">
									<small>欢迎光临,</small>
									<?=Yii::$app->user->identity->username?>
								</span>

            <i class="icon-caret-down"></i>
        </a>

        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
            <li>
                <a href="#">
                    <i class="icon-cog"></i>
                    设置
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="icon-user"></i>
                    个人资料
                </a>
            </li>

            <li class="divider"></li>

            <li>
                <a href="<?= Url::to(["logout"]); ?>">
                    <i class="icon-off"></i>
                    退出
                </a>
            </li>
        </ul>
    </li>
    </ul>
    <!-- /.ace-nav -->
    </div>
    <!-- /.navbar-header -->
    </div>
    <!-- /.container -->
    </div>


    <div class="main-container container-fluid " style="min-width: 700px;">
        <a class="menu-toggler" id="menu-toggler"
           href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <button class="btn btn-success">
                            <i class="icon-signal"></i>
                        </button>

                        <button class="btn btn-info"
                                onclick="javascript:openapp('/admin/cms_post/create.html','41','发布信息')">
                            <i class="icon-pencil"></i>
                        </button>

                        <button class="btn btn-warning"
                                onclick="javascript:openapp('/admin/user_user/index.html','72','会员信息')">
                            <i class="icon-group"></i>
                        </button>

                        <button class="btn btn-danger"
                                onclick="javascript:openapp('/admin/siteconfig/site.html','41','网站配置')">
                            <i class="icon-cogs"></i>
                        </button>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div>

                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span> <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
                </div>
            </div>

            <div id="nav_wraper">

                <?=
                Menu::widget()
                ?>
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="fa fa-angle-double-left"></i>
                </div>
            </div>

        </div>


        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <div id="loading"><i class="loadingicon"></i><span>正在加载...</span></div>
                <div id="right_tools_wrapper">
                    <span id="refresh_wrapper" title="刷新当前页"><i class="fa fa-refresh right_tool_icon"></i></span>
                </div>
                <div id="task-content">
                    <ul class="macro-component-tab" id="task-content-inner">

                        <li class="macro-component-tabitem noclose" app-id="0"
                            app-url="<?= \yii\helpers\Url::to(['main']) ?>" app-name="首页">
                            <span class="macro-tabs-item-text">首页</span>
                        </li>

                    </ul>
                    <div style="clear:both;"></div>
                </div>
            </div>
            <div class="page-content" id="content">

                <iframe src="<?= \yii\helpers\Url::to(['main']) ?>" style="width:100%;height: 100%;" frameborder="0"
                        id="appiframe-0" class="appiframe"></iframe>

            </div>
        </div>
    </div>
    <?php $this->endBody(); ?>

    <script src="<?= Yii::getAlias('@web') ?>/admin/js/index.js"></script>
    <script type="text/javascript">
        $(function () {

            window.prettyPrint && prettyPrint();
            $('#id-check-horizontal')
                .removeAttr('checked')
                .on(
                'click',
                function () {
                    $('#dt-list-1')
                        .toggleClass('dl-horizontal')
                        .prev()
                        .html(
                        this.checked ? '&lt;dl class="dl-horizontal"&gt;'
                            : '&lt;dl&gt;');
                });
        })
    </script>


    </body>
    </html>
<?php $this->endPage() ?>