<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\ResetPasswordForm $model
 */
$this->title = '重置密码';
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/login.css">
<!-- 重置密码开始 -->
<div class="login_bg clearfix">
  <div class="login clearfix">
    <div class="tit">重置密码</div>
    <div class="ct">
      <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
      <div class="enter-area">
        <?= $form->field($model, 'password')->passwordInput()->textInput(['class' => 'txt txt1', 'placeholder' => '请输入新密码'])->label(''); ?>
      </div>
      <?= Html::submitButton('确定', ['class' => 'btn', 'name' => 'login-button']) ?>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<!-- 重置密码结束 -->