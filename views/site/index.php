<?php
/**
 * @var yii\web\View $this
 */
use app\common\includes\CommonUtility;
use yii\helpers\VarDumper;
use yii\helpers\Html;
use app\components\YGong;
use app\common\includes\DataSource;
use app\components\helper\TTimeHelper;
use app\components\widgets\LoopData;
use app\common\includes\UrlUtility;
use yii\helpers\Url;

$this->title = CommonUtility::getConfigValue('seo_title');
$view = \app\components\YGong::getView();
$view->registerMetaTag(['name' => 'keywords', 'content' => CommonUtility::getConfigValue('seo_keywords')]);
$view->registerMetaTag(['name' => 'description', 'content' => CommonUtility::getConfigValue('seo_description')]);
?>

<script src="<?= Yii::getAlias('@web') ?>/static/front/js/common/jquery-1.9.1.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/static/front/js/lanhuwei/index.js"></script>
<!-- 预警提示开始 -->
<div class="frameDiv box1 clearfix">
    <h2><?= Html::a('诈骗案件发布预警提示', Url::toRoute(['/post/index', 'id'=>102]), ['target'=>'_blank'])?></h2>
    <ul>
        <?php
            $fragmentData = DataSource::getContentByChannel(104,['limit'=>1, 'orderby'=>'publish_time', 'where'=>'type=85 and thumbnail <>""']);
            echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item-pic-first','length'=>11]);
        ?>
        <?php
            $fragmentData = DataSource::getContentByChannel(104,['limit'=>3, 'orderby'=>'publish_time', 'where'=>'type=89 and thumbnail <>""']);
            echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item-pic','length'=>14]);
        ?>
    </ul>
</div>
<!-- 预警提示结束 -->
<!-- 图片滚动开始 -->
<div class="sld frameDiv clearfix">
    <div id="prev"></div>
    <ul id="slide">
        <?php
        $fragmentData = DataSource::getContentByChannel('102,104,105,106,110,111,121,112,120,122',['limit'=>8, 'where'=>'type=84 and thumbnail <>""']);
        echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item-pic','length'=>14]);
        ?>
    </ul>
    <div id="next"></div>
</div>
<!-- 图片滚动结束 -->
<!-- 新闻列表开始 -->
<div class="frameDiv">
    <div class="box2 clearfix">
        <?php
            $fragmentData = DataSource::getFraudinfoByType('66,67,68,69',['limit'=>8]);
            echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'fraudinfoitem','length'=>30]);
        ?>
    </div>
</div>
<!-- 新闻列表结束 -->
<!-- 最新防骗信息开始 -->
<div class="frameDiv">
    <div class="box3 clearfix">
        <div class="fl news">
            <div class="tt"><?=Html::a('更多',['/post/index', 'id'=>112], ['target'=>'_blank','class'=>'more'])?><?=Html::a('最新防骗信息',['/post/index', 'id'=>112], ['target'=>'_blank'])?></div>
            <dl class="clearfix">
                <?php
                    $fragmentData = DataSource::getContentByChannel(112,['limit'=>1, 'orderby'=>'publish_time' ,'where' => 'type=89 and thumbnail <>""']);
                    echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item-pic-first2','length'=>11]);
                ?>
            </dl>
            <ul>
                <?php
                    $fragmentData = DataSource::getContentByChannel(112,['limit'=>5]);
                    echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item2','length'=>30]);
                ?>
            </ul>
        </div>
        <div class="fr news">
            <div class="tt"><?=Html::a('更多',['/post/index'], ['target'=>'_blank','class'=>'more'])?><?=Html::a('最新资讯',['/post/index'], ['target'=>'_blank'])?></div>
            <dl class="clearfix">
                <?php
                    $fragmentData = DataSource::getContentByChannel('102,104,105,106,110,111,121,112,120,122',['limit'=>1, 'orderby'=>'publish_time','where' => 'type=89 and thumbnail <>""']);
                    echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item-pic-first2','length'=>25]);
                ?>
            </dl>
            <ul>
                <?php
                    $fragmentData = DataSource::getContentByChannel('102,104,105,106,110,111,121,112,120,122',['limit'=>5]);
                    echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item2','length'=>30]);
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- 最新防骗信息结束 -->
<div class="frameDiv mb20">
    <div class="box4 clearfix">
        <!-- 咨询服务开始 -->
        <div class="fl fuwu">
            <div class="tt"><?=Html::a('诈骗问答',['/post/index', 'id'=>122],['target'=>'_blank'])?></div>
            <dl class="clearfix fw_news">
                <?php
                    $fragmentData = DataSource::getContentByChannel(122,['limit'=>1, 'orderby'=>'publish_time','where' => 'type=89 and thumbnail <>""']);
                    echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item-pic-first2','length'=>28]);
                ?>
            </dl>
            <?php
            $fragmentData = DataSource::getContentByChannel(122,['limit'=>2, 'orderby'=>'publish_time']);
            echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'item-qa','length'=>28]);
            ?>
        </div>
        <!-- 咨询服务结束 -->
        <!-- 常用工具开始 -->
        <div class="fr cygj">
            <div class="tt">常用工具</div>
            <ul>
                <li>
                    <a href="#" target="_blank">
                        <img src="<?= Yii::getAlias('@web') ?>/static/front/images/lanhuwei/img57-57.jpg" width="57" height="57" alt="" />
                        <span>手机号码</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- 常用工具结束 -->
    </div>
</div>