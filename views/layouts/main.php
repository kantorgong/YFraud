<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\common\includes\CommonUtility;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- 头部开始 -->
<div class="top_nav">
    <div class="frameDiv">
        <div class="fl">
            <?= CommonUtility::getConfigValue('site_name')?>欢迎您的光临！
        </div>
        <div class="fr">
            <?php
                if (Yii::$app->user->isGuest)
                {
                    echo Html::a('登陆',['/site/login']).
                    Html::a('注册',['/site/signup']);
                }
                else
                {
                    echo Html::a(Yii::$app->user->identity->username,'#').
                    Html::a('个人中心',['my/view', 'id' => Yii::$app->user->identity->id]).
                    Html::a('退出', ['/site/logout'],['data-method' => 'post']);
                }
            ?>
        </div>
    </div>
</div>
    <!-- 头部开始 -->
<div class="header">
    <div class="frameDiv clearfix">
        <a class="fl" href="/"><h2><img src="<?= Yii::getAlias('@web') ?>/static/front/images/lanhuwei/logo.jpg" alt="蓝护卫" title="蓝护卫" /></h2></a>
        <ul class="nav fr">
            <?php $url = Yii::$app->request->url;?>
            <li <?php echo (strpos($url, '/site/index') > -1 ? 'class="cur"' : '');?>><?=Html::a('首页',Url::toRoute(['/site/index']))?></li>
            <li <?php echo (strpos($url, '/post/index.html') > -1 || strpos($url, '/post/view/') > -1 ? 'class="cur"' : '');?>><?=Html::a('诈骗新闻',Url::toRoute(['/post/index']))?></li>

            <li <?php echo (strpos($url, '/fraudinfo/index') > -1 || strpos($url, '/fraudinfo/view/') > -1 ? 'class="cur"' : '');?>><?=Html::a('最新诈骗',Url::toRoute(['/fraudinfo/index']))?></li>
            <li <?php echo (strpos($url, '/post/index/112.html') > -1  ? 'class="cur"' : '');?>><?=Html::a('诈骗百科',Url::toRoute(['/post/index', 'id'=>112]))?></li>
            <li <?php echo (strpos($url, '/post/index/120.html') > -1 ? 'class="cur"' : '');?>><?=Html::a('防骗课堂',Url::toRoute(['/post/index', 'id'=>120]))?></li>
            <li <?php echo (strpos($url, '/post/index/122.html') > -1  ? 'class="cur"' : '');?>><?=Html::a('诈骗问答',Url::toRoute(['/post/index', 'id'=>122]))?></li>`
        </ul>
    </div>
</div>
<!-- 头部结束 -->
<!-- 搜索开始 -->
<div class="search mb20">
    <div class="frameDiv clearfix">
        <?php
        //$disabled = $model->isNewRecord ? null : 'disabled';
        $form = ActiveForm::begin([
            'fieldConfig' => $this->getDefaultFieldConfig(),
            'action' => ['/fraudinfo/search'],
        ]);
        ?>
        <!-- 搜索切换开始 -->
        <ul class="so_tit">
            <li class="cur">手机</li>
            <li>QQ</li>
            <li>银行卡</li>
            <li>微信名</li>
            <li>淘宝帐号</li>
            <li>网址</li>
        </ul>
        <div class="so_ct fl">
            <input name="medium_content" type="text" class="stxt" onblur="if(this.value=='') this.value='请输入您想搜索的信息';" onfocus="if(this.value=='请输入您想搜索的信息') this.value='';" value="请输入您想搜索的信息" autocomplete="off" />
            <input  type="submit" value="" class="btn" />
        </div>
<!--        <div class="so_ct fl">-->
<!--            <input name="key" type="text" class="stxt" onblur="if(this.value=='') this.value='请输入您想搜索的QQ';" onfocus="if(this.value=='请输入您想搜索的QQ') this.value='';" value="请输入您想搜索的QQ" autocomplete="off" />-->
<!--            <input type="submit" value="" class="btn" />-->
<!--        </div>-->
<!--        <div class="so_ct fl">-->
<!--            <input name="key" type="text" class="stxt" onblur="if(this.value=='') this.value='请输入您想搜索的银行卡';" onfocus="if(this.value=='请输入您想搜索的银行卡') this.value='';" value="请输入您想搜索的银行卡" autocomplete="off" />-->
<!--            <input type="submit" value="" class="btn" />-->
<!--        </div>-->
<!--        <div class="so_ct fl">-->
<!--            <input name="key" type="text" class="stxt" onblur="if(this.value=='') this.value='请输入您想搜索的微信名';" onfocus="if(this.value=='请输入您想搜索的微信名') this.value='';" value="请输入您想搜索的微信名" autocomplete="off" />-->
<!--            <input type="submit" value="" class="btn" />-->
<!--        </div>-->
<!--        <div class="so_ct fl">-->
<!--            <input name="key" type="text" class="stxt" onblur="if(this.value=='') this.value='请输入您想搜索的淘宝帐号';" onfocus="if(this.value=='请输入您想搜索的淘宝帐号') this.value='';" value="请输入您想搜索的淘宝帐号" autocomplete="off" />-->
<!--            <input type="submit" value="" class="btn" />-->
<!--        </div>-->
<!--        <div class="so_ct fl">-->
<!--            <input name="key" type="text" class="stxt" onblur="if(this.value=='') this.value='请输入您想搜索的网址';" onfocus="if(this.value=='请输入您想搜索的网址') this.value='';" value="请输入您想搜索的网址" autocomplete="off" />-->
<!--            <input type="submit" value="" class="btn" />-->
<!--        </div>-->
        <!-- 搜索切换结束 -->
        <?=Html::a('诈骗举报',['fraudinfo/report'],['class'=>'btn_jb'])?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- 搜索结束 -->
            <?= $content ?>


<!-- 安全网址开始 -->
<dl class="frameDiv clearfix mb20 aqwz">
    <dt>安全网址</dt>
    <dd>
        <?php
        $arrSiteFriendLink = CommonUtility::getDicts('site_friend_link', 0);
        $strLink = '';
        $i = 0;
        foreach($arrSiteFriendLink as $key => $value)
        {
            if ($i == 0)
            {
                $strLink .= '<a href="'.$value['value'].'" target="_blank">'.$value['name'].'</a>';
            }
            else
            {
                $strLink .= ' | <a href="'.$value['value'].'" target="_blank">'.$value['name'].'</a>';
            }
            $i++;
        }
        echo $strLink;
        ?>
    </dd>
</dl>
<!-- 安全网址结束 -->
<div id="top"></div>
<!-- 底部开始 -->
<div class="footer">
    <ul class="frameDiv">
        <li><?= \app\widgets\AboutLinkWidget::widget(['max' => 10]) ?></li>
        <li>©<?=date('Y')?>&nbsp;&nbsp;&nbsp;<?= CommonUtility::getConfigValue('site_copyright')?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=CommonUtility::getConfigValue('site_icp')?></li>
    </ul>
</div>
<!-- 底部结束 -->

<span style="display: none">
    <script type="text/javascript">
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fdbe8a52acba73c42df28009ed408d7ac' type='text/javascript'%3E%3C/script%3E"));
    </script>
<script src="http://s11.cnzz.com/z_stat.php?id=1253774751&web_id=1253774751" language="JavaScript"></script>
</span>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
