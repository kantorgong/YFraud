<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\modules\admin\models\Siteconfig $model
 */

$this->title = '修改 站点配置 ';
?>
<div class="clearfix">
    <h4></h4>
</div>

<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
           
        </ul>
        <i class="fa fa-user"></i> <?= $this->title; ?>
    </header>
    <div class="panel-body">
        <div class="col-md-6">
 <?php
    	$form = ActiveForm::begin([
			
	    ]); ?>
    <?= $form->field($model, 'site_name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'site_url')->textInput(['maxlength' => 64]) ?>



    <?= $form->field($model, 'site_admin_email')->textInput(['maxlength' => 64]) ?>
    
    <?= $form->field($model, 'site_icp')->textInput(['maxlength' => 64]) ?>
    
    <?= $form->field($model, 'site_copyright')->textarea(['rows' => 3]) ?>


    
   <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
    <?php ActiveForm::end(); ?> 
</div>
    </div>
</section>
   
