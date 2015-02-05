<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\common\includes\CommonUtility;

/**
* @var yii\web\View $this
* @var app\modules\fraud\models\FraudMediumContent $model
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
			<div class="fraud-medium-content-form">
				<?php $form = ActiveForm::begin(); ?>
				
					
		<?= $form->field($model, 'fraud_medium')->textInput() ?>
				
		<?php
		
		echo $form->field($model, 'fraud_medium', [
			'template' => " {label}\n<div class=\"m-b\">{input}</div>
            \n{error}"
		])->dropDownList(CommonUtility::getDictsList('fraud_medium', 0), [
			'prompt' => isset($model->isNewRecord)?'请选择诈骗介质':CommonUtility::getVariableValue($model->fraud_medium),
			'class' => 'form-control',
			'style' => 'width:40%'
		])
		?>

		<?= $form->field($model, 'fraud_info_id')->textInput() ?>

		<?= $form->field($model, 'medium_content')->textarea(['rows' => 6]) ?>

				
				<div class="form-group">
					
<?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					
				</div>

<?php ActiveForm::end(); ?>

			</div>
		</div>
    </div>
</section>
