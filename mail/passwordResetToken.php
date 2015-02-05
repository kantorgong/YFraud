<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $user
 */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/resetpassword', 'token' => $user->password_reset_token]);
?>

您好  <?= Html::encode($user->username) ?>,</br>

重置密码，请点击以下链接:
<?= Html::a(Html::encode($resetLink), $resetLink) ?>
