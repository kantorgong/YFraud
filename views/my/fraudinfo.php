<?php
use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;
use yii\widgets\Menu;

$this->title = '个人中心';

?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/user.css">
<!-- 用户中心开始 -->
<div class="user frameDiv clearfix">
    <!-- 左侧导航开始 -->
    <div class="uc-nav-box">
        <div class="box-hd">
            <h3 class="title">个人中心</h3>
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
    <!-- 右侧信息开始 -->
    <div class="user_r uc-info-box">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'fraud_info_title',
                        'format'=>'raw',
                        'value' => function ($data) {
                            return Html::a($data['fraud_info_title'], \yii\helpers\Url::to(['/fraudinfo/view', 'id' => $data['fraud_info_id']]), ['title' => '点击查看','target' => '_blank']);
                        },
                    ],
                    'fraud_info_time:datetime',
                    'fraud_info_systime:datetime',

                    ['class' => 'app\modules\admin\components\grid\FrontActionColumn'],
                ],
            ]); ?>

        <!-- 右侧信息结束 -->
    </div>
</div>
<!-- 用户中心结束 -->




