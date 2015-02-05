<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\fraud\models\Fraudinfo $model
 */

$this->title = '修改 诈骗信息: ' . $model->fraud_info_title;
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

