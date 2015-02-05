<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\SignupForm $model
 */
$this->title = '注册';
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/login.css">
<!-- 注册页开始 -->
<div class="login_bg clearfix">
  <div class="regist clearfix">
    <div class="tit">
      <div class="more">已有帐号：<?= Html::a('点击登录', ['login']) ?></div>
      注册蓝护卫帐号
    </div>
    <div class="regist_ct">
      <?php $form = ActiveForm::begin(
          [
              'id' => 'form-signup','errorCssClass' => 'error',
               'fieldConfig' => [
          'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
          'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
          ]

      ); ?>
      <dl>
        <dt>邮箱：</dt>
        <dd>
          <?= $form->field($model, 'email')->textInput(['class' => 'stxt', 'autocomplete' => 'off'])->label(''); ?>
        </dd>
      </dl>
      <dl>
        <dt>昵称：</dt>
        <dd>
          <?= $form->field($model, 'username')->textInput(['class' => 'stxt', 'autocomplete' => 'off'])->label(''); ?>
        </dd>
      </dl>
      <dl>
        <dt>设置密码：</dt>
        <dd>
          <?= $form->field($model, 'password')->passwordInput()->passwordInput(['class' => 'stxt', 'placeholder' => ''])->label(''); ?>
        </dd>
      </dl>
      <dl>
        <dt class="dl_btn_box">&nbsp;</dt>
        <dd>
          <?= Html::submitButton('登录', ['class' => 'btn_zc', 'name' => 'signup-button']) ?>
        </dd>
      </dl>
      <dl>
        <dt>&nbsp;</dt>
        <dd class="xy">
          点击“立即注册”，即表示您同意并愿意遵守蓝护卫<a href="#">用户协议</a>和<a href="#">隐私政策</a>
      </dl>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<!-- 注册页结束 -->