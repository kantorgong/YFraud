<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\admin\Menu $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-bars"></i> <?= Html::encode($this->title) ?>
    </header>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="menu-form">

                <?php $form = ActiveForm::begin(); ?>
                <div class="form-group field-menu-parentid has-success">
                    <label for="menu-parentid" class="control-label">上级菜单ID</label>

                    <select name="Menu[parentid]" class="form-control" id="menu-parentid">
                        <?php echo app\modules\admin\models\Menu::getSelectTree('顶级菜单', $model->parentid, ($model->isNewRecord ? 0 : $model->id)); ?>
                    </select>
                </div>
                <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

                <div class="form-group field-menu-icon">
                    <label for="menu-icon" class="control-label">图标</label>
                    <?= Html::activeHiddenInput($model, 'icon') ?>
                    <a class="bg-light  text-center" style="width: 90px; display: block" data-toggle="modal"
                       data-target="#iconModal" href="javascript:void(0);">
                        <i class="fa fa-<?= ($model->icon)?$model->icon:'desktop'?> inline fa-light fa-3x m-t-large m-b-large" id="menuIcon"></i></a>
                </div>
                <?= $form->field($model, 'controller')->textInput(['maxlength' => 50]) ?>
                <?= $form->field($model, 'action')->textInput(['maxlength' => 20]) ?>
               <?php if($model->isNewRecord):?>
                <div class="form-group field-menu-crud">
                    <div class="checkbox"><label><input type="checkbox" id="menu-crud" name="crud" value="1"> 自动添加 增、删、改</label>
                    </div>
                </div>
                <?php endif;?>
                <?=
                $form->field($model, 'display')->radioList([0 => '是', 1 => '否'], [
                    'itemOptions' => [
                        'container' => ' '
                    ],

                ]) ?>
                <?= $form->field($model, 'description')->textarea(['maxlength' => 200]) ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
<style>
    .the-icons a {
        height: 3.2em;
        display: inline-block;
        text-align: center;
        overflow: inherit;
        padding: 5px;
    }

    .the-icons i {
        font-size: 3em;
        vertical-align: middle;
    }

    .the-icons a:hover i {
        font-size: 3em;
        color: #ff0000;
    }
</style>
<script language="javascript">
    <?php
    ob_start();
    ?>
    $('.the-icons a').click(function () {
        icon = $(this).attr('href');
        $('#menuIcon').attr('class','fa fa-'+icon+' inline fa-light fa-3x m-t-large m-b-large');
        $('#menu-icon').val(icon);
        $('#iconModal').modal('hide');
        return false;
    })
    <?php
    $js = ob_get_clean();
    $this->registerJs($js);
    ?>
</script>

<div class="modal fade" id="iconModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">选择图标</h4>
</div>
<div class="modal-body" style="overflow: auto; height: 400px;">
<div class="the-icons">


<a href="adjust"><i class="fa fa-lg fa-adjust"></i></a>
<a href="anchor"><i class="fa fa-lg fa-anchor"></i></a>
<a href="archive"><i class="fa fa-lg fa-archive"></i></a>
<a href="arrows"><i class="fa fa-lg fa-arrows"></i></a>
<a href="arrows-h"><i class="fa fa-lg fa-arrows-h"></i></a>
<a href="arrows-v"><i class="fa fa-lg fa-arrows-v"></i></a>
<a href="asterisk"><i class="fa fa-lg fa-asterisk"></i></a>
<a href="ban"><i class="fa fa-lg fa-ban"></i></a>
<a href="bar-chart-o"><i class="fa fa-lg fa-bar-chart-o"></i></a>
<a href="barcode"><i class="fa fa-lg fa-barcode"></i></a>
<a href="bars"><i class="fa fa-lg fa-bars"></i></a>
<a href="beer"><i class="fa fa-lg fa-beer"></i></a>
<a href="bell"><i class="fa fa-lg fa-bell"></i></a>
<a href="bell-o"><i class="fa fa-lg fa-bell-o"></i></a>
<a href="bolt"><i class="fa fa-lg fa-bolt"></i></a>
<a href="book"><i class="fa fa-lg fa-book"></i></a>
<a href="bookmark"><i class="fa fa-lg fa-bookmark"></i></a>
<a href="bookmark-o"><i class="fa fa-lg fa-bookmark-o"></i></a>
<a href="briefcase"><i class="fa fa-lg fa-briefcase"></i></a>
<a href="bug"><i class="fa fa-lg fa-bug"></i></a>
<a href="building-o"><i class="fa fa-lg fa-building-o"></i></a>
<a href="bullhorn"><i class="fa fa-lg fa-bullhorn"></i></a>
<a href="bullseye"><i class="fa fa-lg fa-bullseye"></i></a>
<a href="calendar"><i class="fa fa-lg fa-calendar"></i></a>
<a href="calendar-o"><i class="fa fa-lg fa-calendar-o"></i></a>
<a href="camera"><i class="fa fa-lg fa-camera"></i></a>
<a href="camera-retro"><i class="fa fa-lg fa-camera-retro"></i></a>
<a href="caret-square-o-down"><i class="fa fa-lg fa-caret-square-o-down"></i></a>
<a href="caret-square-o-left"><i class="fa fa-lg fa-caret-square-o-left"></i></a>
<a href="caret-square-o-right"><i class="fa fa-lg fa-caret-square-o-right"></i></a>
<a href="caret-square-o-up"><i class="fa fa-lg fa-caret-square-o-up"></i></a>
<a href="certificate"><i class="fa fa-lg fa-certificate"></i></a>
<a href="check"><i class="fa fa-lg fa-check"></i></a>
<a href="check-circle"><i class="fa fa-lg fa-check-circle"></i></a>
<a href="check-circle-o"><i class="fa fa-lg fa-check-circle-o"></i></a>
<a href="check-square"><i class="fa fa-lg fa-check-square"></i></a>
<a href="check-square-o"><i class="fa fa-lg fa-check-square-o"></i></a>
<a href="circle"><i class="fa fa-lg fa-circle"></i></a>
<a href="circle-o"><i class="fa fa-lg fa-circle-o"></i></a>
<a href="clock-o"><i class="fa fa-lg fa-clock-o"></i></a>
<a href="cloud"><i class="fa fa-lg fa-cloud"></i></a>
<a href="cloud-download"><i class="fa fa-lg fa-cloud-download"></i></a>
<a href="cloud-upload"><i class="fa fa-lg fa-cloud-upload"></i></a>
<a href="code"><i class="fa fa-lg fa-code"></i></a>
<a href="code-fork"><i class="fa fa-lg fa-code-fork"></i></a>
<a href="coffee"><i class="fa fa-lg fa-coffee"></i></a>
<a href="cog"><i class="fa fa-lg fa-cog"></i></a>
<a href="cogs"><i class="fa fa-lg fa-cogs"></i></a>
<a href="comment"><i class="fa fa-lg fa-comment"></i></a>
<a href="comment-o"><i class="fa fa-lg fa-comment-o"></i></a>
<a href="comments"><i class="fa fa-lg fa-comments"></i></a>
<a href="comments-o"><i class="fa fa-lg fa-comments-o"></i></a>
<a href="compass"><i class="fa fa-lg fa-compass"></i></a>
<a href="credit-card"><i class="fa fa-lg fa-credit-card"></i></a>
<a href="crop"><i class="fa fa-lg fa-crop"></i></a>
<a href="crosshairs"><i class="fa fa-lg fa-crosshairs"></i></a>
<a href="cutlery"><i class="fa fa-lg fa-cutlery"></i></a>
<a href="tachometer"><i class="fa fa-lg fa-dashboard"></i></a>
<a href="desktop"><i class="fa fa-lg fa-desktop"></i></a>
<a href="dot-circle-o"><i class="fa fa-lg fa-dot-circle-o"></i></a>
<a href="download"><i class="fa fa-lg fa-download"></i></a>
<a href="pencil-square-o"><i class="fa fa-lg fa-edit"></i></a>
<a href="ellipsis-h"><i class="fa fa-lg fa-ellipsis-h"></i></a>
<a href="ellipsis-v"><i class="fa fa-lg fa-ellipsis-v"></i></a>
<a href="envelope"><i class="fa fa-lg fa-envelope"></i></a>
<a href="envelope-o"><i class="fa fa-lg fa-envelope-o"></i></a>
<a href="eraser"><i class="fa fa-lg fa-eraser"></i></a>
<a href="exchange"><i class="fa fa-lg fa-exchange"></i></a>
<a href="exclamation"><i class="fa fa-lg fa-exclamation"></i></a>
<a href="exclamation-circle"><i class="fa fa-lg fa-exclamation-circle"></i></a>
<a href="exclamation-triangle"><i class="fa fa-lg fa-exclamation-triangle"></i></a>
<a href="external-link"><i class="fa fa-lg fa-external-link"></i></a>
<a href="external-link-square"><i class="fa fa-lg fa-external-link-square"></i></a>
<a href="eye"><i class="fa fa-lg fa-eye"></i></a>
<a href="eye-slash"><i class="fa fa-lg fa-eye-slash"></i></a>
<a href="female"><i class="fa fa-lg fa-female"></i></a>
<a href="fighter-jet"><i class="fa fa-lg fa-fighter-jet"></i></a>
<a href="film"><i class="fa fa-lg fa-film"></i></a>
<a href="filter"><i class="fa fa-lg fa-filter"></i></a>
<a href="fire"><i class="fa fa-lg fa-fire"></i></a>
<a href="fire-extinguisher"><i class="fa fa-lg fa-fire-extinguisher"></i></a>
<a href="flag"><i class="fa fa-lg fa-flag"></i></a>
<a href="flag-checkered"><i class="fa fa-lg fa-flag-checkered"></i></a>
<a href="flag-o"><i class="fa fa-lg fa-flag-o"></i></a>
<a href="bolt"><i class="fa fa-lg fa-flash"></i></a>
<a href="flask"><i class="fa fa-lg fa-flask"></i></a>
<a href="folder"><i class="fa fa-lg fa-folder"></i></a>
<a href="folder-o"><i class="fa fa-lg fa-folder-o"></i></a>
<a href="folder-open"><i class="fa fa-lg fa-folder-open"></i></a>
<a href="folder-open-o"><i class="fa fa-lg fa-folder-open-o"></i></a>
<a href="frown-o"><i class="fa fa-lg fa-frown-o"></i></a>
<a href="gamepad"><i class="fa fa-lg fa-gamepad"></i></a>
<a href="gavel"><i class="fa fa-lg fa-gavel"></i></a>
<a href="cog"><i class="fa fa-lg fa-gear"></i></a>
<a href="cogs"><i class="fa fa-lg fa-gears"></i></a>
<a href="gift"><i class="fa fa-lg fa-gift"></i></a>
<a href="glass"><i class="fa fa-lg fa-glass"></i></a>
<a href="globe"><i class="fa fa-lg fa-globe"></i></a>
<a href="users"><i class="fa fa-lg fa-group"></i></a>
<a href="hdd-o"><i class="fa fa-lg fa-hdd-o"></i></a>
<a href="headphones"><i class="fa fa-lg fa-headphones"></i></a>
<a href="heart"><i class="fa fa-lg fa-heart"></i></a>
<a href="heart-o"><i class="fa fa-lg fa-heart-o"></i></a>
<a href="home"><i class="fa fa-lg fa-home"></i></a>
<a href="inbox"><i class="fa fa-lg fa-inbox"></i></a>
<a href="info"><i class="fa fa-lg fa-info"></i></a>
<a href="info-circle"><i class="fa fa-lg fa-info-circle"></i></a>
<a href="key"><i class="fa fa-lg fa-key"></i></a>
<a href="keyboard-o"><i class="fa fa-lg fa-keyboard-o"></i></a>
<a href="laptop"><i class="fa fa-lg fa-laptop"></i></a>
<a href="leaf"><i class="fa fa-lg fa-leaf"></i></a>
<a href="gavel"><i class="fa fa-lg fa-legal"></i></a>
<a href="lemon-o"><i class="fa fa-lg fa-lemon-o"></i></a>
<a href="level-down"><i class="fa fa-lg fa-level-down"></i></a>
<a href="level-up"><i class="fa fa-lg fa-level-up"></i></a>
<a href="lightbulb-o"><i class="fa fa-lg fa-lightbulb-o"></i></a>
<a href="location-arrow"><i class="fa fa-lg fa-location-arrow"></i></a>
<a href="lock"><i class="fa fa-lg fa-lock"></i></a>
<a href="magic"><i class="fa fa-lg fa-magic"></i></a>
<a href="magnet"><i class="fa fa-lg fa-magnet"></i></a>
<a href="share"><i class="fa fa-lg fa-mail-forward"></i></a>
<a href="reply"><i class="fa fa-lg fa-mail-reply"></i></a>
<a href="mail-reply-all"><i class="fa fa-lg fa-mail-reply-all"></i></a>
<a href="male"><i class="fa fa-lg fa-male"></i></a>
<a href="map-marker"><i class="fa fa-lg fa-map-marker"></i></a>
<a href="meh-o"><i class="fa fa-lg fa-meh-o"></i></a>
<a href="microphone"><i class="fa fa-lg fa-microphone"></i></a>
<a href="microphone-slash"><i class="fa fa-lg fa-microphone-slash"></i></a>
<a href="minus"><i class="fa fa-lg fa-minus"></i></a>
<a href="minus-circle"><i class="fa fa-lg fa-minus-circle"></i></a>
<a href="minus-square"><i class="fa fa-lg fa-minus-square"></i></a>
<a href="minus-square-o"><i class="fa fa-lg fa-minus-square-o"></i></a>
<a href="mobile"><i class="fa fa-lg fa-mobile"></i></a>
<a href="mobile"><i class="fa fa-lg fa-mobile-phone"></i></a>
<a href="money"><i class="fa fa-lg fa-money"></i></a>
<a href="moon-o"><i class="fa fa-lg fa-moon-o"></i></a>
<a href="music"><i class="fa fa-lg fa-music"></i></a>
<a href="pencil"><i class="fa fa-lg fa-pencil"></i></a>
<a href="pencil-square"><i class="fa fa-lg fa-pencil-square"></i></a>
<a href="pencil-square-o"><i class="fa fa-lg fa-pencil-square-o"></i></a>
<a href="phone"><i class="fa fa-lg fa-phone"></i></a>
<a href="phone-square"><i class="fa fa-lg fa-phone-square"></i></a>
<a href="picture-o"><i class="fa fa-lg fa-picture-o"></i></a>
<a href="plane"><i class="fa fa-lg fa-plane"></i></a>
<a href="plus"><i class="fa fa-lg fa-plus"></i></a>
<a href="plus-circle"><i class="fa fa-lg fa-plus-circle"></i></a>
<a href="plus-square"><i class="fa fa-lg fa-plus-square"></i></a>
<a href="plus-square-o"><i class="fa fa-lg fa-plus-square-o"></i></a>
<a href="power-off"><i class="fa fa-lg fa-power-off"></i></a>
<a href="print"><i class="fa fa-lg fa-print"></i></a>
<a href="puzzle-piece"><i class="fa fa-lg fa-puzzle-piece"></i></a>
<a href="qrcode"><i class="fa fa-lg fa-qrcode"></i></a>
<a href="question"><i class="fa fa-lg fa-question"></i></a>
<a href="question-circle"><i class="fa fa-lg fa-question-circle"></i></a>
<a href="quote-left"><i class="fa fa-lg fa-quote-left"></i></a>
<a href="quote-right"><i class="fa fa-lg fa-quote-right"></i></a>
<a href="random"><i class="fa fa-lg fa-random"></i></a>
<a href="refresh"><i class="fa fa-lg fa-refresh"></i></a>
<a href="reply"><i class="fa fa-lg fa-reply"></i></a>
<a href="reply-all"><i class="fa fa-lg fa-reply-all"></i></a>
<a href="retweet"><i class="fa fa-lg fa-retweet"></i></a>
<a href="road"><i class="fa fa-lg fa-road"></i></a>
<a href="rocket"><i class="fa fa-lg fa-rocket"></i></a>
<a href="rss"><i class="fa fa-lg fa-rss"></i></a>
<a href="rss-square"><i class="fa fa-lg fa-rss-square"></i></a>
<a href="search"><i class="fa fa-lg fa-search"></i></a>
<a href="search-minus"><i class="fa fa-lg fa-search-minus"></i></a>
<a href="search-plus"><i class="fa fa-lg fa-search-plus"></i></a>
<a href="share"><i class="fa fa-lg fa-share"></i></a>
<a href="share-square"><i class="fa fa-lg fa-share-square"></i></a>
<a href="share-square-o"><i class="fa fa-lg fa-share-square-o"></i></a>
<a href="shield"><i class="fa fa-lg fa-shield"></i></a>
<a href="shopping-cart"><i class="fa fa-lg fa-shopping-cart"></i></a>
<a href="sign-in"><i class="fa fa-lg fa-sign-in"></i></a>
<a href="sign-out"><i class="fa fa-lg fa-sign-out"></i></a>
<a href="signal"><i class="fa fa-lg fa-signal"></i></a>
<a href="sitemap"><i class="fa fa-lg fa-sitemap"></i></a>
<a href="smile-o"><i class="fa fa-lg fa-smile-o"></i></a>
<a href="sort"><i class="fa fa-lg fa-sort"></i></a>
<a href="sort-alpha-asc"><i class="fa fa-lg fa-sort-alpha-asc"></i></a>
<a href="sort-alpha-desc"><i class="fa fa-lg fa-sort-alpha-desc"></i></a>
<a href="sort-amount-asc"><i class="fa fa-lg fa-sort-amount-asc"></i></a>
<a href="sort-amount-desc"><i class="fa fa-lg fa-sort-amount-desc"></i></a>
<a href="sort-asc"><i class="fa fa-lg fa-sort-asc"></i></a>
<a href="sort-desc"><i class="fa fa-lg fa-sort-desc"></i></a>
<a href="sort-asc"><i class="fa fa-lg fa-sort-down"></i></a>
<a href="sort-numeric-asc"><i class="fa fa-lg fa-sort-numeric-asc"></i></a>
<a href="sort-numeric-desc"><i class="fa fa-lg fa-sort-numeric-desc"></i></a>
<a href="sort-desc"><i class="fa fa-lg fa-sort-up"></i></a>
<a href="spinner"><i class="fa fa-lg fa-spinner"></i></a>
<a href="square"><i class="fa fa-lg fa-square"></i></a>
<a href="square-o"><i class="fa fa-lg fa-square-o"></i></a>
<a href="star"><i class="fa fa-lg fa-star"></i></a>
<a href="star-half"><i class="fa fa-lg fa-star-half"></i></a>
<a href="star-half-o"><i class="fa fa-lg fa-star-half-empty"></i></a>
<a href="star-half-o"><i class="fa fa-lg fa-star-half-full"></i></a>
<a href="star-half-o"><i class="fa fa-lg fa-star-half-o"></i></a>
<a href="star-o"><i class="fa fa-lg fa-star-o"></i></a>
<a href="subscript"><i class="fa fa-lg fa-subscript"></i></a>
<a href="suitcase"><i class="fa fa-lg fa-suitcase"></i></a>
<a href="sun-o"><i class="fa fa-lg fa-sun-o"></i></a>
<a href="superscript"><i class="fa fa-lg fa-superscript"></i></a>
<a href="tablet"><i class="fa fa-lg fa-tablet"></i></a>
<a href="tachometer"><i class="fa fa-lg fa-tachometer"></i></a>
<a href="tag"><i class="fa fa-lg fa-tag"></i></a>
<a href="tags"><i class="fa fa-lg fa-tags"></i></a>
<a href="tasks"><i class="fa fa-lg fa-tasks"></i></a>
<a href="terminal"><i class="fa fa-lg fa-terminal"></i></a>
<a href="thumb-tack"><i class="fa fa-lg fa-thumb-tack"></i></a>
<a href="thumbs-down"><i class="fa fa-lg fa-thumbs-down"></i></a>
<a href="thumbs-o-down"><i class="fa fa-lg fa-thumbs-o-down"></i></a>
<a href="thumbs-o-up"><i class="fa fa-lg fa-thumbs-o-up"></i></a>
<a href="thumbs-up"><i class="fa fa-lg fa-thumbs-up"></i></a>
<a href="ticket"><i class="fa fa-lg fa-ticket"></i></a>
<a href="times"><i class="fa fa-lg fa-times"></i></a>
<a href="times-circle"><i class="fa fa-lg fa-times-circle"></i></a>
<a href="times-circle-o"><i class="fa fa-lg fa-times-circle-o"></i></a>
<a href="tint"><i class="fa fa-lg fa-tint"></i></a>
<a href="caret-square-o-down"><i class="fa fa-lg fa-toggle-down"></i></a>
<a href="caret-square-o-left"><i class="fa fa-lg fa-toggle-left"></i></a>
<a href="caret-square-o-right"><i class="fa fa-lg fa-toggle-right"></i></a>
<a href="caret-square-o-up"><i class="fa fa-lg fa-toggle-up"></i></a>
<a href="trash-o"><i class="fa fa-lg fa-trash-o"></i></a>
<a href="trophy"><i class="fa fa-lg fa-trophy"></i></a>
<a href="truck"><i class="fa fa-lg fa-truck"></i></a>
<a href="umbrella"><i class="fa fa-lg fa-umbrella"></i></a>
<a href="unlock"><i class="fa fa-lg fa-unlock"></i></a>
<a href="unlock-alt"><i class="fa fa-lg fa-unlock-alt"></i></a>
<a href="sort"><i class="fa fa-lg fa-unsorted"></i></a>
<a href="upload"><i class="fa fa-lg fa-upload"></i></a>
<a href="user"><i class="fa fa-lg fa-user"></i></a>
<a href="users"><i class="fa fa-lg fa-users"></i></a>
<a href="video-camera"><i class="fa fa-lg fa-video-camera"></i></a>
<a href="volume-down"><i class="fa fa-lg fa-volume-down"></i></a>
<a href="volume-off"><i class="fa fa-lg fa-volume-off"></i></a>
<a href="volume-up"><i class="fa fa-lg fa-volume-up"></i></a>
<a href="exclamation-triangle"><i class="fa fa-lg fa-warning"></i></a>
<a href="wheelchair"><i class="fa fa-lg fa-wheelchair"></i></a>
<a href="wrench"><i class="fa fa-lg fa-wrench"></i></a>
<a href="check-square"><i class="fa fa-check-square"></i></a>
<a href="check-square-o"><i class="fa fa-check-square-o"></i></a>
<a href="circle"><i class="fa fa-circle"></i></a>
<a href="circle-o"><i class="fa fa-circle-o"></i></a>
<a href="dot-circle-o"><i class="fa fa-dot-circle-o"></i></a>
<a href="minus-square"><i class="fa fa-minus-square"></i></a>
<a href="minus-square-o"><i class="fa fa-minus-square-o"></i></a>
<a href="plus-square"><i class="fa fa-plus-square"></i></a>
<a href="plus-square-o"><i class="fa fa-plus-square-o"></i></a>
<a href="square"><i class="fa fa-square"></i></a>
<a href="square-o"><i class="fa fa-square-o"></i></a>
<a href="btc"><i class="fa fa-bitcoin"></i></a>
<a href="btc"><i class="fa fa-btc"></i></a>
<a href="jpy"><i class="fa fa-cny"></i></a>
<a href="usd"><i class="fa fa-dollar"></i></a>
<a href="eur"><i class="fa fa-eur"></i></a>
<a href="eur"><i class="fa fa-euro"></i></a>
<a href="gbp"><i class="fa fa-gbp"></i></a>
<a href="inr"><i class="fa fa-inr"></i></a>
<a href="jpy"><i class="fa fa-jpy"></i></a>
<a href="krw"><i class="fa fa-krw"></i></a>
<a href="money"><i class="fa fa-money"></i></a>
<a href="jpy"><i class="fa fa-rmb"></i></a>
<a href="rub"><i class="fa fa-rouble"></i></a>
<a href="rub"><i class="fa fa-rub"></i></a>
<a href="rub"><i class="fa fa-ruble"></i></a>
<a href="inr"><i class="fa fa-rupee"></i></a>
<a href="try"><i class="fa fa-try"></i></a>
<a href="try"><i class="fa fa-turkish-lira"></i></a>
<a href="usd"><i class="fa fa-usd"></i></a>
<a href="krw"><i class="fa fa-won"></i></a>
<a href="jpy"><i class="fa fa-yen"></i></a>
<a href="align-center"><i class="fa fa-align-center"></i></a>
<a href="align-justify"><i class="fa fa-align-justify"></i></a>
<a href="align-left"><i class="fa fa-align-left"></i></a>
<a href="align-right"><i class="fa fa-align-right"></i></a>
<a href="bold"><i class="fa fa-bold"></i></a>
<a href="link"><i class="fa fa-chain"></i></a>
<a href="chain-broken"><i class="fa fa-chain-broken"></i></a>
<a href="clipboard"><i class="fa fa-clipboard"></i></a>
<a href="columns"><i class="fa fa-columns"></i></a>
<a href="files-o"><i class="fa fa-copy"></i></a>
<a href="scissors"><i class="fa fa-cut"></i></a>
<a href="outdent"><i class="fa fa-dedent"></i></a>
<a href="eraser"><i class="fa fa-eraser"></i></a>
<a href="file"><i class="fa fa-file"></i></a>
<a href="file-o"><i class="fa fa-file-o"></i></a>
<a href="file-text"><i class="fa fa-file-text"></i></a>
<a href="file-text-o"><i class="fa fa-file-text-o"></i></a>
<a href="files-o"><i class="fa fa-files-o"></i></a>
<a href="floppy-o"><i class="fa fa-floppy-o"></i></a>
<a href="font"><i class="fa fa-font"></i></a>
<a href="indent"><i class="fa fa-indent"></i></a>
<a href="italic"><i class="fa fa-italic"></i></a>
<a href="link"><i class="fa fa-link"></i></a>
<a href="list"><i class="fa fa-list"></i></a>
<a href="list-alt"><i class="fa fa-list-alt"></i></a>
<a href="list-ol"><i class="fa fa-list-ol"></i></a>
<a href="list-ul"><i class="fa fa-list-ul"></i></a>
<a href="outdent"><i class="fa fa-outdent"></i></a>
<a href="paperclip"><i class="fa fa-paperclip"></i></a>
<a href="clipboard"><i class="fa fa-paste"></i></a>
<a href="repeat"><i class="fa fa-repeat"></i></a>
<a href="undo"><i class="fa fa-rotate-left"></i></a>
<a href="repeat"><i class="fa fa-rotate-right"></i></a>
<a href="floppy-o"><i class="fa fa-save"></i></a>
<a href="scissors"><i class="fa fa-scissors"></i></a>
<a href="strikethrough"><i class="fa fa-strikethrough"></i></a>
<a href="table"><i class="fa fa-table"></i></a>
<a href="text-height"><i class="fa fa-text-height"></i></a>
<a href="text-width"><i class="fa fa-text-width"></i></a>
<a href="th"><i class="fa fa-th"></i></a>
<a href="th-large"><i class="fa fa-th-large"></i></a>
<a href="th-list"><i class="fa fa-th-list"></i></a>
<a href="underline"><i class="fa fa-underline"></i></a>
<a href="undo"><i class="fa fa-undo"></i></a>
<a href="chain-broken"><i class="fa fa-unlink"></i></a>
<a href="angle-double-down"><i class="fa fa-angle-double-down"></i></a>
<a href="angle-double-left"><i class="fa fa-angle-double-left"></i></a>
<a href="angle-double-right"><i class="fa fa-angle-double-right"></i></a>
<a href="angle-double-up"><i class="fa fa-angle-double-up"></i></a>
<a href="angle-down"><i class="fa fa-angle-down"></i></a>
<a href="angle-left"><i class="fa fa-angle-left"></i></a>
<a href="angle-right"><i class="fa fa-angle-right"></i></a>
<a href="angle-up"><i class="fa fa-angle-up"></i></a>
<a href="arrow-circle-down"><i class="fa fa-arrow-circle-down"></i></a>
<a href="arrow-circle-left"><i class="fa fa-arrow-circle-left"></i></a>
<a href="arrow-circle-o-down"><i class="fa fa-arrow-circle-o-down"></i></a>
<a href="arrow-circle-o-left"><i class="fa fa-arrow-circle-o-left"></i></a>
<a href="arrow-circle-o-right"><i class="fa fa-arrow-circle-o-right"></i></a>
<a href="arrow-circle-o-up"><i class="fa fa-arrow-circle-o-up"></i></a>
<a href="arrow-circle-right"><i class="fa fa-arrow-circle-right"></i></a>
<a href="arrow-circle-up"><i class="fa fa-arrow-circle-up"></i></a>
<a href="arrow-down"><i class="fa fa-arrow-down"></i></a>
<a href="arrow-left"><i class="fa fa-arrow-left"></i></a>
<a href="arrow-right"><i class="fa fa-arrow-right"></i></a>
<a href="arrow-up"><i class="fa fa-arrow-up"></i></a>
<a href="arrows"><i class="fa fa-arrows"></i></a>
<a href="arrows-alt"><i class="fa fa-arrows-alt"></i></a>
<a href="arrows-h"><i class="fa fa-arrows-h"></i></a>
<a href="arrows-v"><i class="fa fa-arrows-v"></i></a>
<a href="caret-down"><i class="fa fa-caret-down"></i></a>
<a href="caret-left"><i class="fa fa-caret-left"></i></a>
<a href="caret-right"><i class="fa fa-caret-right"></i></a>
<a href="caret-square-o-down"><i class="fa fa-caret-square-o-down"></i></a>
<a href="caret-square-o-left"><i class="fa fa-caret-square-o-left"></i></a>
<a href="caret-square-o-right"><i class="fa fa-caret-square-o-right"></i></a>
<a href="caret-square-o-up"><i class="fa fa-caret-square-o-up"></i></a>
<a href="caret-up"><i class="fa fa-caret-up"></i></a>
<a href="chevron-circle-down"><i class="fa fa-chevron-circle-down"></i></a>
<a href="chevron-circle-left"><i class="fa fa-chevron-circle-left"></i></a>
<a href="chevron-circle-right"><i class="fa fa-chevron-circle-right"></i></a>
<a href="chevron-circle-up"><i class="fa fa-chevron-circle-up"></i></a>
<a href="chevron-down"><i class="fa fa-chevron-down"></i></a>
<a href="chevron-left"><i class="fa fa-chevron-left"></i></a>
<a href="chevron-right"><i class="fa fa-chevron-right"></i></a>
<a href="chevron-up"><i class="fa fa-chevron-up"></i></a>
<a href="hand-o-down"><i class="fa fa-hand-o-down"></i></a>
<a href="hand-o-left"><i class="fa fa-hand-o-left"></i></a>
<a href="hand-o-right"><i class="fa fa-hand-o-right"></i></a>
<a href="hand-o-up"><i class="fa fa-hand-o-up"></i></a>
<a href="long-arrow-down"><i class="fa fa-long-arrow-down"></i></a>
<a href="long-arrow-left"><i class="fa fa-long-arrow-left"></i></a>
<a href="long-arrow-right"><i class="fa fa-long-arrow-right"></i></a>
<a href="long-arrow-up"><i class="fa fa-long-arrow-up"></i></a>
<a href="caret-square-o-down"><i class="fa fa-toggle-down"></i></a>
<a href="caret-square-o-left"><i class="fa fa-toggle-left"></i></a>
<a href="caret-square-o-right"><i class="fa fa-toggle-right"></i></a>
<a href="caret-square-o-up"><i class="fa fa-toggle-up"></i></a>
<a href="arrows-alt"><i class="fa fa-arrows-alt"></i></a>
<a href="backward"><i class="fa fa-backward"></i></a>
<a href="compress"><i class="fa fa-compress"></i></a>
<a href="eject"><i class="fa fa-eject"></i></a>
<a href="expand"><i class="fa fa-expand"></i></a>
<a href="fast-backward"><i class="fa fa-fast-backward"></i></a>
<a href="fast-forward"><i class="fa fa-fast-forward"></i></a>
<a href="forward"><i class="fa fa-forward"></i></a>
<a href="pause"><i class="fa fa-pause"></i></a>
<a href="play"><i class="fa fa-play"></i></a>
<a href="play-circle"><i class="fa fa-play-circle"></i></a>
<a href="play-circle-o"><i class="fa fa-play-circle-o"></i></a>
<a href="step-backward"><i class="fa fa-step-backward"></i></a>
<a href="step-forward"><i class="fa fa-step-forward"></i></a>
<a href="stop"><i class="fa fa-stop"></i></a>
<a href="youtube-play"><i class="fa fa-youtube-play"></i></a>
<a href="adn"><i class="fa fa-adn"></i></a>
<a href="android"><i class="fa fa-android"></i></a>
<a href="apple"><i class="fa fa-apple"></i></a>
<a href="bitbucket"><i class="fa fa-bitbucket"></i></a>
<a href="bitbucket-square"><i class="fa fa-bitbucket-square"></i></a>
<a href="btc"><i class="fa fa-bitcoin"></i></a>
<a href="btc"><i class="fa fa-btc"></i></a>
<a href="css3"><i class="fa fa-css3"></i></a>
<a href="dribbble"><i class="fa fa-dribbble"></i></a>
<a href="dropbox"><i class="fa fa-dropbox"></i></a>
<a href="facebook"><i class="fa fa-facebook"></i></a>
<a href="facebook-square"><i class="fa fa-facebook-square"></i></a>
<a href="flickr"><i class="fa fa-flickr"></i></a>
<a href="foursquare"><i class="fa fa-foursquare"></i></a>
<a href="github"><i class="fa fa-github"></i></a>
<a href="github-alt"><i class="fa fa-github-alt"></i></a>
<a href="github-square"><i class="fa fa-github-square"></i></a>
<a href="gittip"><i class="fa fa-gittip"></i></a>
<a href="google-plus"><i class="fa fa-google-plus"></i></a>
<a href="google-plus-square"><i class="fa fa-google-plus-square"></i></a>
<a href="html5"><i class="fa fa-html5"></i></a>
<a href="instagram"><i class="fa fa-instagram"></i></a>
<a href="linkedin"><i class="fa fa-linkedin"></i></a>
<a href="linkedin-square"><i class="fa fa-linkedin-square"></i></a>
<a href="linux"><i class="fa fa-linux"></i></a>
<a href="maxcdn"><i class="fa fa-maxcdn"></i></a>
<a href="pagelines"><i class="fa fa-pagelines"></i></a>
<a href="pinterest"><i class="fa fa-pinterest"></i></a>
<a href="pinterest-square"><i class="fa fa-pinterest-square"></i></a>
<a href="renren"><i class="fa fa-renren"></i></a>
<a href="skype"><i class="fa fa-skype"></i></a>
<a href="stack-exchange"><i class="fa fa-stack-exchange"></i></a>
<a href="stack-overflow"><i class="fa fa-stack-overflow"></i></a>
<a href="trello"><i class="fa fa-trello"></i></a>
<a href="tumblr"><i class="fa fa-tumblr"></i></a>
<a href="tumblr-square"><i class="fa fa-tumblr-square"></i></a>
<a href="twitter"><i class="fa fa-twitter"></i></a>
<a href="twitter-square"><i class="fa fa-twitter-square"></i></a>
<a href="vimeo-square"><i class="fa fa-vimeo-square"></i></a>
<a href="vk"><i class="fa fa-vk"></i></a>
<a href="weibo"><i class="fa fa-weibo"></i></a>
<a href="windows"><i class="fa fa-windows"></i></a>
<a href="xing"><i class="fa fa-xing"></i></a>
<a href="xing-square"><i class="fa fa-xing-square"></i></a>
<a href="youtube"><i class="fa fa-youtube"></i></a>
<a href="youtube-play"><i class="fa fa-youtube-play"></i></a>
<a href="youtube-square"><i class="fa fa-youtube-square"></i></a>
<a href="ambulance"><i class="fa fa-ambulance"></i></a>
<a href="h-square"><i class="fa fa-h-square"></i></a>
<a href="hospital-o"><i class="fa fa-hospital-o"></i></a>
<a href="medkit"><i class="fa fa-medkit"></i></a>
<a href="plus-square"><i class="fa fa-plus-square"></i></a>
<a href="stethoscope"><i class="fa fa-stethoscope"></i></a>
<a href="user-md"><i class="fa fa-user-md"></i></a>
<a href="wheelchair"><i class="fa fa-wheelchair"></i></a>


</div>
</div>

</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
