<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\Menu;
use app\modules\admin\widget\menu;
?>
<!-- header -->
<header id="header" class="navbar">
    <ul class="nav navbar-nav  pull-right">

        <li>
            <div class="m-t-small"><a class="btn btn-sm btn-info" data-toggle="modal"
                                      href="<?= Url::to(['logout']); ?>"><i
                        class="fa fa-power-off"></i> 退出</a></div>
        </li>
    </ul>
    <a class="navbar-brand" href="#">综合运营管理平台</a>
    <button type="button" class="btn btn-link pull-left nav-toggle visible-xs"
            data-toggle="class:slide-nav slide-nav-left" data-target="body">
        <i class="fa fa-bars fa-lg text-default"></i>
    </button>


</header>
<!-- / header -->
<!-- nav -->
<nav id="nav" class="nav-primary  nav-vertical">
    <?=
    Menu::widget()
    ?>
    <!--    <ul class="nav" data-spy="affix" data-offset-top="50">-->
    <!--        <li class="active">-->
    <!--            <a href="-->
    <? //= Url::to(['main']); ?><!--"><i class="fa fa-dashboard fa-lg"></i><span>控制台</span></a>-->
    <!--        </li>-->
    <!---->
    <!--        <li class="dropdown-submenu">-->
    <!--            <a href="#"><i class="fa fa-gears fa-lg"></i><span>系统设置</span></a>-->
    <!--            <ul class="dropdown-menu">-->
    <!--                <li><a href="--><? //= Url::to(['/admin/user/index']); ?><!--">用户</a></li>-->
    <!--                <li><a href="--><? //= Url::to(['/admin/role/index']); ?><!--">角色</a></li>-->
    <!--                <li><a href="--><? //= Url::to(['/admin/menu/index']); ?><!--">菜单</a></li>-->
    <!--            </ul>-->
    <!--        </li>-->
    <!---->
    <!--    </ul>-->
</nav>
<!-- / nav -->
<section id="content">
    <section class="main padder">
        <iframe id="iframe_default" src="<?= Url::to(['main']); ?>" style=" width: 100%;" frameborder="0"
                scrolling="auto"></iframe>
    </section>
</section>


<script lang="javascritp">
    <?php
  ob_start();
  ?>
    iframeDefault = function () {
        $('#iframe_default').height($(window).height() - $('#header').height() - 10);
    }
    $(function () {
        iframeDefault();
        $(window).resize(function () {
            iframeDefault();
        })
        $('#nav a').click(function () {
            $('#iframe_default').attr('src', $(this).attr('href'));
            $('#nav .active').removeClass('active');
            $(this).parents('li').addClass('active');
            return false;
        });

    });
    <?php
      $js = ob_get_clean();
      $this->registerJs($js);
      ?>
</script>