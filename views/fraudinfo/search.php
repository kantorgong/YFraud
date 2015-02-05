<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\widgets\CategoryWidget;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\PageSearch $searchModel
 */


    $this->title = '诈骗搜索';
    $this->registerMetaTag(['name' => 'keywords', 'content' => "诈骗搜索"]);
    $this->registerMetaTag(['name' => 'description', 'content' => '诈骗搜索。']);


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
    <?= Html::a('诈骗信息', ['fraudinfo/index']) ?>
    <?php if (is_array($fraud_type)) { ?>
        > <?= Html::a(Html::encode($fraud_type['name']), ['fraudinfo/index', 'id'=>$fraud_type['id']]) ?>
    <?php } ?>
</div>
<!-- 面包屑结束 -->
<!-- 列表开始 -->
<div class="frameDiv list">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_fraudinfo_search_listview',
        'summary' => '',
    ]) ?>

</div>

</div>
<!-- 列表结束 -->
