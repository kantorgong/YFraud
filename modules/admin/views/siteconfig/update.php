<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\Siteconfig $model
 */

$this->title = '修改 Siteconfig: ' . $model->id;
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

