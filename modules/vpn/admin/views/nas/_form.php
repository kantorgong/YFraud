<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\vpn\models\Nas $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="nas-form">

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'shortname')->textInput(['maxlength' => 32]) ?>
                <?= $form->field($model, 'nasname')->textInput(['maxlength' => 128]) ?>



                <?= $form->field($model, 'ports')->textInput() ?>





                <?= $form->field($model, 'secret')->textInput(['maxlength' => 60]) ?>


                <?= $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 32]) ?>
                <?= $form->field($model, 'description')->textInput(['maxlength' => 200]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
