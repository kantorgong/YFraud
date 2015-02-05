<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\widgets\Tabs;
use app\common\includes\CommonUtility;
use app\modules\admin\models\sysprovince;
use app\modules\fraud\models\FraudMediumContent;
use app\modules\admin\Controllers\SysprovinceController;
/**
* @var yii\web\View $this
* @var app\modules\fraud\models\Fraudinfo $model
* @var yii\widgets\ActiveForm $form
*/

$this->registerJsFile(Yii::getAlias('@web') . '/admin/timepicker/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web') . '/admin/timepicker/js/jquery-ui-slide.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web') . '/admin/timepicker/js/jquery-ui-timepicker-addon.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web') . '/admin/js/cxselect/jquery.cxselect.min.js',['depends' => 'yii\web\JqueryAsset']);
?>
<style type="text/css">
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px;}
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
.ui_tpicker_hour_label,.ui_tpicker_minute_label,.ui_tpicker_second_label,.ui_tpicker_millisec_label,.ui_tpicker_time_label{padding-left:20px}
</style>

<link rel="stylesheet" type="text/css" href="<?= Yii::getAlias('@web') ?>/admin/timepicker/css/jquery-ui.css" />



<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>
    <div class="panel-body">
        <div class="col-md-8">
			<div class="fraudinfo-form class="form-horizontal"">
				 <?php
		$disabled = $model->isNewRecord ? null : 'disabled';
		$form = ActiveForm::begin([
			'fieldConfig' => $this->getDefaultFieldConfig(),
		]);
	?>
    <?php 
	  Tabs::begin([
	      'items' => [
	          ['label' => '基本信息', 'contentId' => 'tableBasic'],
	          ['label' => '扩展信息', 'contentId' => 'tableExt'],
	          ['label' => '系统信息', 'contentId' => 'tableSys'],
	      ],
	  ]);
	?>	
			
	<div id="tableBasic" class="tab-pane active">						
		<?= $form->field($model, 'fraud_info_title')->textInput(['maxlength' => 200]) ?>
		
		
		<?=
		$form->field($model, 'fraud_type_id', [
			'template' => " {label}\n<div class=\"m-b\">{input}</div>
            \n{error}"
		])->dropDownList(CommonUtility::getDictsList('fraud_type', 0), [
			'prompt' => '请选择诈骗类型',
			'class' => 'form-control',
			'style' => 'width:100%'
		])
		?>
		 <?= $form->field($model, 'fraud_info_tags')->textInput(['maxlength' => 300]) ?>
		<?= $form->field($model, 'fraud_info_usertags')->textInput(['maxlength' => 300]) ?>
		<?php if($model->isNewRecord){$model->fraud_info_time=Date('Y-m-d,H:m:s');} echo $form->field($model, 'fraud_info_time',['options'=>[]])->textInput(); ?>

		
		<fieldset id="city_china" style="width:100%">
			<div  class="row" style="width:100%">
				<div class="col-xs-1" style="width:30%">
			省份：<select class="province form-control" style="width:100%" data-value="<? if($model->isNewRecord){$model->fraud_info_province='河南省';} echo $model->fraud_info_province;?>" disabled="disabled" name="Fraudinfo[fraud_info_province]"></select>
				</div>
				<div class="col-xs-2" style="width:30%">
			城市：<select class="city form-control" style="width:100%" data-value="<? if($model->isNewRecord){$model->fraud_info_city='郑州市';} echo $model->fraud_info_city;?>" disabled="disabled" name="Fraudinfo[fraud_info_city]"></select>
				</div>
				<div class="col-xs-3" style="width:30%">
			地区：<select class="area form-control" style="width:100%" data-value="<? if($model->isNewRecord){$model->fraud_info_area='金水区';} echo $model->fraud_info_area;?>" disabled="disabled" name="Fraudinfo[fraud_info_area]"></select>
				</div>
				</div>
		</fieldset>
        <?= $form->field($model, 'fraud_info_address')->textInput(['width' => '400px','maxlength' => 200]) ?>


		<?= $form->field($model, 'fraud_info_content')->textarea(['rows' => 6]) ?>
		
		
	</div>

<div id="tableExt" class="tab-pane">

		<?= $form->field($model, 'fraud_info_depict')->textarea(['rows' => 6]) ?>
	
	
	<?php
	//介质内容
	
	if(!$model->isNewRecord)
	{
		$fmc = FraudMediumContent::getFraudMediumContentByFraudid($model->fraud_info_id);
		foreach ($fmc as $key2 => $value2) {
							$arr[$key2] = $value2['fraud_medium'];
		}
        if(isset($arr))
        {
            $fmcone = array_flip(array_flip($arr));//去除重复的元素
            //设置原来的选项
            $model->fraud_info_numtype = $fmcone;
        }
	}
	echo $form->field($model, 'fraud_info_numtype',['template'=>'<span class=\"check\">{label}{input}</span>'])->checkboxList(CommonUtility::getDictsList('fraud_medium', 0), [
		'itemOptions' => [
			'container' => ' ',
			'class' => 'checkboxList',
			'style' => "display: inline-block;width:40px;",
		],
    ]) ?>
	
	<?php

	    //介质分类
		$fm = CommonUtility::getDictsList('fraud_medium', 0);
		
		foreach ($fm as $key => $value) {
				foreach ($fmc as $key2 => $value2) {
						if(array_key_exists($value2['fraud_medium'],$fm)){
							if($key == $value2['fraud_medium']){
								echo "<lable style='padding:5px'    id='fraud_info_numtype_" . $value2['fraud_medium'] . "'>" . $value . " : <input class='form-control' value='".$value2['medium_content']."'    name='edit_medium_content_" . $value2['id'] . "'  /> </lable>";
							}
						}	
						else {
							echo "<lable style='display:none;padding:5px'    id='fraud_info_numtype_" . $key . "'>" . $value . " : <input class='form-control'    name='medium_content_" . $key . "'  /> </lable>";
						}
					}
			}
	?>

</div>

<div id="tableSys" class="tab-pane">
	<?php
		if($model->isNewRecord){$model->fraud_info_iscryptonym=0;}
		echo $form->field($model, 'fraud_info_iscryptonym')->radioList([0 => '不匿名', 1 => '匿名'], [
			'itemOptions' => [
				'container' => ' '
			],
		])
		?>

	
	<div  class="row" style="width:100%">
				<div class="col-xs-1" style="width:30%">
					<?= $form->field($model, 'fraud_info_userid')->textInput() ?>
				</div>
				<div class="col-xs-2" style="width:30%">
			<?= $form->field($model, 'fraud_info_nickname')->textInput(['maxlength' => 50]) ?>
				</div>
				</div>
	
	
		
		
		<?= $form->field($model, 'fraud_info_ip')->textInput(['maxlength' => 100]) ?>
	<?php if($model->isNewRecord){$model->fraud_info_systime=Date('Y-m-d,H:m:s');} echo $form->field($model, 'fraud_info_systime',['options'=>[]])->textInput(); ?>
		
		<?php
		if($model->isNewRecord){$model->fraud_info_status=0;}
		echo $form->field($model, 'fraud_info_status')->radioList([0 => '正常', 1 => '删除'], [
			'itemOptions' => [
				'container' => ' '
			],
		])
		?>
		<?= $form->field($model, 'fraud_info_views')->textInput() ?>
</div>
				
				<div class="form-group">
					
<?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				
				</div>
  <?php Tabs::end();?>
<?php ActiveForm::end(); ?>
	
			</div>
		</div>
    </div>
</section>

<script type="text/javascript">
    <?php
ob_start();
?>
    $(function(){
        $('#fraudinfo-fraud_info_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#fraudinfo-fraud_info_systime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });


    $(".checkboxList").click(function(){
        if($('#fraud_info_numtype_'+$(this).val()).css('display') == 'none')
            $('#fraud_info_numtype_'+$(this).val()).show();
        else
            $('#fraud_info_numtype_'+$(this).val()).hide();
    });




    $.cxSelect.defaults.url = '<?= Yii::getAlias('@web') ?>/admin/js/cxselect/cityData.min.json';

    $('#city_china').cxSelect({
        selects: ['province', 'city', 'area']
    });

    $('#city_china_val').cxSelect({
        selects: ['province', 'city', 'area'],
        nodata: 'none'
    });

    $('#global_location').cxSelect({
        url: 'js/globalData.min.json',
        selects: ['country', 'state', 'city', 'region'],
        nodata: 'none'
    });

    <?php
       $js = ob_get_clean();
       $this->registerJs($js);
       ?>
</script>