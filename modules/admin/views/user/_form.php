<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Role;
use yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var common\models\admin\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-user"></i> <?= $this->title; ?>
    </header>
    <div class="panel-body">
        <div class="col-md-6">

            <?php $form = ActiveForm::begin([
                'options' => [
                    'autocomplete' => 'off'
                ]
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => 50]) ?>

            <?php if ($model->scenario == 'update'): ?>
                <?= $form->field($model, 'password', ['parts' => ['{hint}' => '不修改请留空',]])->passwordInput(['value' => '']) ?>
            <?php else: ?>
                <?= $form->field($model, 'password')->passwordInput([]) ?>
            <?php endif; ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>


            <?=
            $form->field($model, 'role_id', [
                'template' => " {label}\n<div class=\"m-b\">{input}</div>
            \n{error}"
            ])->dropDownList(Role::listDate(), [
                    'prompt' => '请选择角色',
                    'class' => '',
                    'style' => 'width:100%'
                ]) ?>

            <?php
                    $model->status =1;
            echo $form->field($model, 'status')->radioList([0=>'是', 1=>'否'], [
                'itemOptions' => [
                    'container' => ' '
                ],

            ]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>

<script>
    var server_config = null;
    <?php
    ob_start();
    ?>

    $("#user-role_id").select2();

    <?php
    $js = ob_get_clean();
    $this->registerJs($js);
    ?>
</script>