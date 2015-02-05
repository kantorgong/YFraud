<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\fraud\models\FraudMediumContent $model
 */

$this->title = '添加 诈骗介质';
?>

<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
