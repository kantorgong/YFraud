<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\web\JqueryAsset;
use app\common\includes\CommonUtility;

/**
 * @var yii\web\View $this
 */
$this->title = $model->seo_title?$model->seo_title:$model->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords?$model->seo_keywords:$model->tags]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description?$model->seo_description:$model->MakeSummary]);
$this->registerJsFile('js/jquery.cookie-1.4.1.min.js', [JqueryAsset::className()]);
$this->registerJs('
jQuery(".add-like").on("click", function (e) {
    if ($.cookie("post-'.$model->id.'")!=1) {
        $.get("'.Url::to(["post/like", "id" => $model->id]).'");
        $.cookie("post-'.$model->id.'", "1");
        $(this).children("span").css("color","red");
    }
    return false; 
});
jQuery(document).ready(function () {
    if ($.cookie("post-'.$model->id.'")) {
        $(".add-like").children("span").css("color","red");
    }
});
');
?>
<?php
if ($category->id == 112)
{
 ?>
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/baike.css">
<?php
}
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/newscont.css">
<script src="<?= Yii::getAlias('@web') ?>/static/front/js/common/jquery-1.9.1.min.js"></script>
<!-- 面包屑开始 -->
<div class="mbx frameDiv">
    <span></span><a href="/" target="_blank">蓝护卫</a> >
    <?= Html::a('资讯', ['post/index']) ?>
    <?php if ($category){ ?>
        > <?= Html::a(Html::encode($category->name), ['post/index', 'id'=>$category->id]) ?>
    <?php }?>
</div>
<!-- 面包屑结束 -->

<!-- 信息展示开始 -->
<div class="infoshow frameDiv clearfix">
    <div class="cnew_l">
        <div class="ctit">
            <h1><?= Html::encode($model->title) ?></h1>
            <div><span>来源： <?= $model->source?$model->source?Html::a(CommonUtility::getDict('cms_post_source',$model->source)['name'],CommonUtility::getDict('cms_post_source',$model->source)['value']):$model->source:"" ?></span><span>作者： <?= Html::encode($model->writer?$model->writer:"") ?></span><span>时间：<?= date("Y-m-d H:i:s", $model->published_at) ?></span></div>
        </div>
        <div class="ccont">
            <?= $model->content ?>
            <br/><br/>
            <?php
            $imageType = ['.gif', '.jpg', '.jpeg', '.png', '.doc', '.rar'];
            if (in_array(strtolower(strrchr($model->thumbnail, '.')), $imageType))
            {
                echo '相关图片：<br/><img width="400px" src="'.$model->thumbnail.'" />';
            }
//            else
//            {
//                echo '诈骗相关附件：<br/><a style="text-decoration:underline;" target="_blank" href="'.$model->thumbnail.'" >下载</a>';
//            }
            ?>
            <p><?= $model->tags?"标签：":"" ?><?= implode(', ', $model->tagLinks); ?></p>
        </div>
        <!-- 翻页开始 -->
        <?php if ($pages->totalCount>1): ?>
            <?= LinkPager::widget(['pagination' => $pages]) ?>
        <?php endif ?>
        <!-- 翻页结束 -->
        <div class="cshare clearfix">
            <?= \app\widgets\ShareButton::widget() ?>
        </div>
        <div class="cxgyd clearfix">
            <strong class="ctt">相关阅读</strong>
            <?php if ($model->AboutRead): ?>
                <?php $i = 1; $str1='';$str2=''?>
                <?php foreach ($model->AboutRead as $key => $value): ?>
                    <?php
                    if($i == 1 || $i == 2 || $i == 3)
                    {
                        $str1 .= '<li><a href="'. Url::to(['post/view', 'id' => $value['id']]) .'">'. Html::encode($value['title']) .'</a></li>';
                    }
                    else
                    {
                        $str2 .= '<li><a href="'. Url::to(['post/view', 'id' => $value['id']]) .'">'. Html::encode($value['title']) .'</a></li>';
                    }
                    ?>
                    <?php $i++;?>
                <?php endforeach ?>
                    <ul class="clearfix">
                        <?=$str1?>
                    </ul>
                    <ul class="c_ydr clearfix">
                        <?=$str2?>
                    </ul>
                <?php endif ?>

        </div>
        <!-- 评论开始 -->
        <?php if (!$model->disallow_comment): ?>
        <div id="top_reply">
                <?= $this->render("_comment", ['id' => $model->id, 'parent_id' => 0]) ?>
            <li class="pl-title-new">最新评论</li>

                <?= $this->render("_comments", ['id' => $model->id]) ?>

        </div>
    <?php endif ?>
        <!-- 评论结束 -->
    </div>
    <div class="cnew_r">
        <div class="crmtw">
            <strong class="ctt">热门图文</strong>
            <ul class="clearfix">
                <?= \app\widgets\HotPic::widget(['max' => 6]) ?>
            </ul>
        </div>
        <div class="crmtwline">
            <strong class="ctt">热门推荐</strong>
            <ul class="clearfix">
                <?= \app\widgets\HotArticles::widget(['max' => 10]) ?>
            </ul>
        </div>
        <div class="cpdct">
            <strong class="ctt">频道词条</strong>
            <div class="clearfix">
                <?= \app\widgets\TagCloud::widget(['max'=>Yii::$app->params['tagCloudCount']]) ?>
            </div>
        </div>
    </div>
</div>
<!-- 信息展示结束 -->





