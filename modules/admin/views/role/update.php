<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\admin\Role $model
 */

$this->title = '修改角色';
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

