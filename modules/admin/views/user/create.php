<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\admin\User $model
 */
$this->title = '添加用户';;
?>
<div class="clearfix">
    <h4></h4>
</div>
<?php echo $this->render('_form', [
    'model' => $model,
]); ?>
