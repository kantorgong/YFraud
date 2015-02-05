<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\Dict $model
 */

$this->title = '修改字典：'. $model->name;
$this->addBreadcrumb('字典分类',['dict-category/index']);
$this->addBreadcrumb($category['name'],['dict/index','catid'=>$category['id']]);
foreach ($parents as $item)
{
	$this->addBreadcrumb($item->name, ['index','pid'=>$item->id,'catid'=>$category['id']]);
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearfix">
    <h4></h4>
</div>
 <?= $this->render('_form', [
        'model' => $model,
    		'parent'=>$parent,
    		'category'=>$category,
    ]) ?>

