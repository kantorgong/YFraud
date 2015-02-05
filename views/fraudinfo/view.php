<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\web\JqueryAsset;
use app\common\includes\CommonUtility;
use app\common\includes\DataSource;
use app\components\widgets\LoopData;
/**
 * @var yii\web\View $this
 */
$fragmentData = DataSource::getFraudmdediumByid($model->fraud_info_id, ['limit'=>10]);

$this->title = $model->fraud_info_title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->fraud_info_title.$model->fraud_info_usertags.$model->fraud_info_tags]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->fraud_info_title.$model->fraud_info_depict]);
$this->registerJsFile('js/jquery.cookie-1.4.1.min.js', [JqueryAsset::className()]);
$this->registerJs('
jQuery(".add-like").on("click", function (e) {
    if ($.cookie("post-'.$model->fraud_info_id.'")!=1) {
        $.get("'.Url::to(["post/like", "id" => $model->fraud_info_id]).'");
        $.cookie("post-'.$model->fraud_info_id.'", "1");
        $(this).children("span").css("color","red");
    }
    return false; 
});
jQuery(document).ready(function () {
    if ($.cookie("post-'.$model->fraud_info_id.'")) {
        $(".add-like").children("span").css("color","red");
    }
});
');
?>

<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/newscont.css">
<script src="<?= Yii::getAlias('@web') ?>/static/front/js/common/jquery-1.9.1.min.js"></script>
<!-- 面包屑开始 -->
<div class="mbx frameDiv">
    <span></span><a href="/" target="_blank">蓝护卫</a> >
    <?= Html::a('诈骗', ['fraudinfo/index']) ?>
    <?php if ($fraud_type){ ?>
        > <?= Html::a(Html::encode($fraud_type['name']), ['fraudinfo/index', 'id'=>$fraud_type['id']]) ?>
    <?php }?>
</div>
<!-- 面包屑结束 -->

<!-- 信息展示开始 -->
<div class="infoshow frameDiv clearfix">
    <div class="cnew_l">
        <div class="ctit">
            <?php
            if($model->fraud_info_nickname == 'robot')
            {
                $model->fraud_info_nickname ='游客';
            }
            ?>
            <h1><?= Html::encode($model->fraud_info_title) ?></h1>
            <div><span>来源： 诈骗地点：<?= $model->fraud_info_province.'&nbsp;'.$model->fraud_info_city.'&nbsp;'.$model->fraud_info_area.'&nbsp;'.$model->fraud_info_address ?></span></div>
            <div><span>举报网友： <?= $model->fraud_info_iscryptonym==0?Html::encode($model->fraud_info_nickname):'匿名' ?></span><span>标签：<?= $model->fraud_info_usertags ?></span><span>诈骗时间：<?= $model->fraud_info_time ?></span></div>
        </div>
        <div class="ccont">
            <?= $model->fraud_info_content ?>
            <?php echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'fraudinfomediumcontentview','length'=>30]);?>

            <dl>
                <?php
            $imageType = ['.gif', '.jpg', '.jpeg', '.png', '.doc', '.rar'];
            if (in_array(strtolower(strrchr($model->fraud_info_doc, '.')), $imageType))
//            {
//                echo '<dt>相关图片：</dt><dd><img width="400px" src="'.$model->fraud_info_doc.'" /></dd>';
//            }
//            else
            {
                echo '<dt>相关附件：</dt><dd><a style="text-decoration:underline;" target="_blank" href="'.$model->fraud_info_doc.'" >下载</a></dd>';
            }
            ?>
            </dl>

            <p><?= $model->fraud_info_usertags.$model->fraud_info_tags ?></p>
        </div>
        <div class="cshare clearfix">
            <?= \app\widgets\ShareButton::widget() ?>
        </div>

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





