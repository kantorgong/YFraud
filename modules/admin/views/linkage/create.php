<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\Linkage $model
 */

$this->title = '添加数据字典';
?>

<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
