<?php
use yii\helpers\Url;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\YGong;

/**
* @var yii\web\View $this
* @var app\modules\admin\models\Dict $model
* @var yii\widgets\ActiveForm $form
*/
?>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index','catid'=>$category['id']])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>
    <div class="dict-form">

    <?php
    	$disabled= $model->isNewRecord? null:'disabled';
    	$form = ActiveForm::begin([
			'fieldConfig' => $this->getDefaultFieldConfig(),
	    ]); ?>
	    <table class="table">
	
		<tr class="form-group field-dict-parent_id required">
			<td class="hAlign_left padding_r10">
				<label style="font-weight:normal;" for="dict-parent_id">分类</label>:</td>
			<td><?php echo $category['name'],'(',$category['id'],')'?></td>
			<td><div class="help-block"></div></td>
		</tr>
		
		<tr class="form-group field-dict-parent_id required">
			<td class="hAlign_left padding_r10">
				<label style="font-weight:normal;" for="dict-parent_id">父级</label>:</td>
			<td><?php echo $parent->name?></td>
			<td><div class="help-block"></div></td>
		</tr>
		
	    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
	
	    <?= $form->field($model, 'value')->textarea(['rows' => 3]) ?>

	    
	    <?= $form->field($model, 'sort_num')->textInput() ?>
	    
	    
	    
		</table>
	  <?php $this->echoButtons2($model); ?>
    <?php ActiveForm::end(); ?>

</div>
</section>
