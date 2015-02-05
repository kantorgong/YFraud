<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = '登录';
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/login.css">
<!-- 面包屑开始 -->
<div class="mbx frameDiv">
  <span></span><a href="/" target="_blank">蓝护卫</a> >
  登录
</div>
<!-- 面包屑结束 -->
<!-- 登录页开始 -->
<div class="login_bg clearfix">
  <div class="login clearfix">
    <div class="tit">登录蓝护卫帐号</div>
    <div class="ct">
      <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'errorCssClass' => 'error',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
          'template' => "{label}\n<div class=\"col-lg-4\" style=\"width:348px\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
          'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
      ]); ?>
      <div class="enter-area">

        <?php echo $form->field($model, 'username')->textInput(['class' => 'stxt txt1', 'placeholder' => '用户名'])->label('用户名：'); ?>
      </div>
      <div class="enter-area">
        <?= $form->field($model, 'password')->passwordInput(['class' => 'stxt txt2', 'placeholder' => '密码'])->label('密码：'); ?>
      </div>
      <label class="col-lg-2 control-label" for="loginform-username">&nbsp;</label><?= Html::submitButton('登录', ['class' => 'btns', 'name' => 'login-button']) ?>
        <div class="pl120">
          <div class="zddl-area">
        <label for="zddl"><?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"\">{input}</div>",
            ])->checkbox(['text' => '记住我']) ?></label>
        <div class="more"><?= Html::a('忘记密码？', ['requestpasswordreset']) ?></div>
      </div>
      <?= Html::a('马上注册', ['signup'], ['class'=>'btns btn_zc']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<!-- 登录页结束 -->