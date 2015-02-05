<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var common\models\admin\Role $model
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
			<div class="role-form">

				<?php $form = ActiveForm::begin([
                    'id' => 'role-form',
                    'enableAjaxValidation' => true
                ]); ?>

				<?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

				<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

				<?= $form->field($model, 'disabled')->radioList(['是','否'],[
                    'itemOptions'=> [
                        'container' => ' '
                    ],

                ]) ?>

				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>

				<?php ActiveForm::end(); ?>

			</div>
		</div>
    </div>
</section>
