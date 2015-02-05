<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\fraud\models\FraudMediumContent $model
 */

$this->title = '修改 诈骗介质: ' . $model->id;
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

