<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\widgets\CategoryWidget;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\PageSearch $searchModel
 */
if ($category) {
    $this->title = $category->seo_title ? $category->seo_title : $category->name;
    $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seo_keywords ? $category->seo_keywords : ""]);
    $this->registerMetaTag(['name' => 'description', 'content' => $category->seo_description ? $category->seo_description : $category->seo_description]);
} else {
    $this->title = '资讯';
    $this->registerMetaTag(['name' => 'keywords', 'content' => "资讯列表"]);
    $this->registerMetaTag(['name' => 'description', 'content' => '资讯列表信息。']);

}
?>
<script src="<?= Yii::getAlias('@web') ?>/static/front/js/common/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/list.css">
<div class="row post-list" style="display: none">

    <div class="col-md-3">
        <div class="side-right">
            <?= \app\widgets\RecommendArticles::widget(['max' => 10]) ?>
            <br>
            <?= \app\widgets\HotArticles::widget(['max' => 10]) ?>
            <br>
            <h4>Tags</h4>
            <?= \app\widgets\TagCloud::widget(['max' => Yii::$app->params['tagCloudCount']]) ?>

        </div>
    </div>
</div>


<!-- 面包屑开始 -->
<div class="mbx frameDiv">
    <span></span><a href="/" target="_blank">蓝护卫</a> >
    <?= Html::a('资讯', ['post/index']) ?>
    <?php if ($category) { ?>
        > <?= Html::a(Html::encode($category->name), ['post/index', 'id'=>$category->id]) ?>
    <?php } ?>
</div>
<!-- 面包屑结束 -->
<!-- 列表开始 -->
<div class="frameDiv list">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_post_index_listview',
        'summary' => '',
    ]) ?>

</div>

</div>
<!-- 列表结束 -->
