<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\admin\Menu $model
 */

$this->title = '添加菜单';
?>

<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>
