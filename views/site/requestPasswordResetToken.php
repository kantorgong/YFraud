<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\PasswordResetRequestForm $model
 */
$this->title = '找回密码';
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/login.css">
<!-- 重置密码开始 -->
<div class="login_bg clearfix">
  <div class="login clearfix">
    <div class="tit"><?=$this->title?></div>
    <div class="ct">
      <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form','errorCssClass' => 'error',]); ?>
      <div class="enter-area">
        <?= $form->field($model, 'email')->passwordInput()->textInput(['class' => 'txt txt1', 'placeholder' => '请输入邮箱'])->label(''); ?>
      </div>
      <?= Html::submitButton('确定', ['class' => 'btn', 'name' => 'request-password-reset-button']) ?>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<!-- 找回密码结束 -->

