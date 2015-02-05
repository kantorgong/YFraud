<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu;
/**
 * @var yii\web\View $this
 */
$this->title = $model->seo_title?$model->seo_title:$model->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords?$model->seo_keywords:""]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description?$model->seo_description:""]);
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/about.css">
<!-- 用户中心开始 -->
<div class="user frameDiv clearfix">
    <!-- 左侧导航开始 -->
    <div class="uc-nav-box">
        <div class="box-hd">
            <h3 class="title">关于我们</h3>
        </div>
        <div class="box-bd">
                <?= Menu::widget([
                    'options' => ['class' => 'uc-nav-list'],
                    'activeCssClass' => 'cur',
                    'items' => $menuItems,
                    'encodeLabels' => false
                ]);?>
        </div>
    </div>
    <!-- 左侧导航结束 -->

    <div class="user_r uc-info-box">
        <div class="tit"><?= Html::encode($model->title) ?></div>
        <div class="regist_ct">
            <?= $model->content ?>
        </div>
        <!-- 右侧信息结束 -->
    </div>
</div>


