<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Post $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => Yii::t('app', 'Posts'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
