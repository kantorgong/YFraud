<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\sysprovince $model
 */

$this->title = '添加Sysprovince';
?>

<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
