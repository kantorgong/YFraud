<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\fraud\models\Fraudinfo $model
 */

$this->title = '添加 诈骗信息';
?>

<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
