<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

echo "<?php\n";
?>

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var <?= ltrim($generator->modelClass, '\\') ?> $model
 */

$this->title = '添加<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>';
?>

<div class="clearfix">
    <h4></h4>
</div>
<?= "<?php " ?>echo $this->render('_form', [
		'model' => $model,
	]); ?>
