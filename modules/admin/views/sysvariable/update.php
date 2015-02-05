<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\sysvariable $model
 */

$this->title='修改 自定义变量'. $model->name;
$this->addBreadcrumb('自定义变量',['sysvariable/index']);
$this->addBreadCrumb($this->title);
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

