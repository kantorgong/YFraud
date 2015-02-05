<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\sysvariable $model
 */

$this->title = '添加 自定义变量';
$this->addBreadcrumb('自定义变量',['sysvariable/index']);
$this->addBreadcrumb('添加 自定义变量',['sysvariable/create']);
?>

<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
