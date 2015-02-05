<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */
/** @var \yii\db\ActiveRecord $model */
$model = new $generator->modelClass;
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
	$safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var <?= ltrim($generator->modelClass, '\\') ?> $model
* @var yii\widgets\ActiveForm $form
*/
?>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= "<?" ?>= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= "<?= " ?>Html::encode($this->title) ?>
    </header>
    <div class="panel-body">
        <div class="col-md-6">
			<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
				<?= "<?php " ?>$form = ActiveForm::begin(); ?>
				
					
				<?php
				foreach ($safeAttributes as $attribute) {
					echo "\t\t<?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
				}
				?>
				
				<div class="form-group">
					
<?= "<?= " ?>Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					
				</div>

<?= "<?php " ?>ActiveForm::end(); ?>

			</div>
		</div>
    </div>
</section>
