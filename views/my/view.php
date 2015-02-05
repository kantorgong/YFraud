<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Alert;
use yii\widgets\Menu;

$this->title = '个人中心';

?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/user.css">
<!-- 用户中心开始 -->
<div class="user frameDiv clearfix">
    <?= Alert::widget() ?>
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
        <div class="tit">资料修改</div>
        <div class="regist_ct">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>
            <dl>
                <dt>头像</dt>
                <dd>
                    <?php if ($model->avatar) : ?>
                        <img src="<?= $model->avatar ?>" width="100" height="100">
                    <?php else : ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/default.jpg" width="100" height="100">
                    <?php endif ?>
<div style="margin-left: 100px">
                        <?= $form->field($userform, 'avatar')->fileInput(['class' => 'btn btn-large', 'title' => '请选本地图片'])->label('') ?>
</div>
                </dd>
            </dl>
            <dl>
                <dt>用户名：</dt>
                <dd>
                    <?= $form->field($userform, 'username')->textInput(['class' => 'txt','readonly'=>'readonly'])->label('') ?>
                </dd>
            </dl>
            <dl>
                <dt>邮箱：</dt>
                <dd>
                    <?= $form->field($userform, 'email')->textInput(['class' => 'txt'])->label('') ?>
                </dd>
            </dl>
            <dl>
                <dt>密码：</dt>
                <dd>
                    <?= $form->field($userform, 'password')->passwordInput(['class' => 'txt'])->label('') ?>
                </dd>
            </dl>
            <dl>
                <dt>&nbsp;</dt>
                <dd>
                    <?= Html::submitButton('确定', ['class' => 'btn_zc']) ?>
                </dd>
            </dl>
            <?php ActiveForm::end(); ?>
        </div>
        <!-- 右侧信息结束 -->
    </div>
</div>
<!-- 用户中心结束 -->




