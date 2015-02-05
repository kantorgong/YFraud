<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\vpn\models\Nas $model
 */

$this->title = '修改 Nas: ' . $model->id;
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

