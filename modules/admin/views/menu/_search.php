<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\MenuSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'icon') ?>

		<?= $form->field($model, 'parentid') ?>

		<?= $form->field($model, 'controller') ?>

		<?php // echo $form->field($model, 'action') ?>

		<?php // echo $form->field($model, 'description') ?>

		<?php // echo $form->field($model, 'listorder') ?>

		<?php // echo $form->field($model, 'display') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
