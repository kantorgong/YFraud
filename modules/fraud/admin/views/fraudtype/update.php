<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\fraud\models\fraudtype $model
 */

$this->title = '修改 Fraudtype: ' . $model->fraud_type_id;
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

