<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\imagine\image;
use app\components\widgets\Tabs;
use app\components\Common;
use yii\jui\AutoCompleteAsset;
use app\components\helper\TStringHelper;
use app\common\includes\CommonUtility;
use yii\web\View;


//$this->registerJsFile(Yii::getAlias('@web') . '/admin/js/jquery.js',['position' => View::POS_HEAD]);

$options = '<option value="0">根节点</option>';
foreach($this->channels as $row)
{
	$style = '';
	if(!$row['is_leaf'])
	{
		$style = ' disabled="disabled" style="color:red;"';
	}
	else if($model['category_id'] == intval($row['id']) || $_GET['chnid'] == intval($row['id']))
	{
		$style = ' selected';
	}
	$options .= '<option value="' . $row['id'] . '"' . $style . '>' . TStringHelper::blank($row['level']) . $row['name_alias'] . '</option>';
}
?>


<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode(Yii::t('app', 'Article')) ?>
    </header>
    <div class="panel-body">
        <div class="col-md-9" style="padding-left:0px;">
			<div class="post-form" class="form-horizontal"">
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
	          ['label' => 'SEO信息', 'contentId' => 'tableExt'],
	      ],
	  ]);
	?>	
			
	<div id="tableBasic" class="tab-pane active">						
		
		  <?= $form->field($model, 'title')->textInput() ?>
               
				
				<div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
				<div class="form-group field-post-category_id">
<?= Html::activeLabel($model, 'category_id') ?>	
				<select id="Post[category_id]" class="form-control" name="Post[category_id]">
				<?php echo $options?>
				</select>
                            <p class="help-block"></p>
				</div>
                        </div>
     
                        <div class="col-md-4">
                             <?= $form->field($model, 'type')->dropDownList(CommonUtility::getDictsList('cms_post_type', 0), [
			'prompt' => '请选择类型',
			'class' => 'form-control',
			'style' => 'width:100%'
		]) ?>
                            <p class="help-block"></p>
                        </div>
                    </div>
                </div>
				
				
				<div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                             <?= $form->field($model, 'source')->dropDownList(CommonUtility::getDictsList('cms_post_source', 0), [
			'prompt' => '请选择来源',
			'class' => 'form-control',
			'style' => 'width:100%'
		]) ?>
                            <p class="help-block"></p>
                        </div>
     
                        <div class="col-md-4">
                            <?= Html::activeLabel($model, 'writer') ?>
                            <?= Html::activeTextInput($model, 'writer', ['class' => 'form-control']) ?>
                            <p class="help-block"></p>
                        </div>
                    </div>
                </div>
				
		
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                         <?= $form->field($model, 'url')->textInput() ?>
                            <p class="help-block"></p>
                        </div>
     
                        <div class="col-md-4">
                             <?= $form->field($model, 'tags')->textInput() ?>
							<p class="help-block"></p>
                        </div>
                    </div>
                </div>               
                <?=\djfly\kindeditor\KindEditor::widget([
                    'id' => 'post-content',
                    'model' => $model,
                    'attribute' => 'content',
                    'items' => [
                        'langType' => Yii::$app->language=="zh-CN"?"zh_CN":Yii::$app->language,
                        'height' => '350px',
                        'themeType' => 'simple',
                        'pagebreakHtml' => Yii::$app->params['pagebreakHtml'],
                        'allowImageUpload' => true,
                        'allowFileManager' => true,
                        'uploadJson' => Url::toRoute('createimgajax'),
                        'fileManagerJson' => Url::toRoute('post/filemanager'),
                        
                    ],
                ])?>
                
                <?= $form->field($model, 'content')->textArea(['rows' => 10]) ?>

                <?= $form->field($model, 'summary')->textArea(['rows' => 5]) ?>
		
	</div>

<div id="tableExt" class="tab-pane">

		 <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'seo_description')->textArea(['rows' => 5]) ?>

</div>
						
  <?php Tabs::end();?>

	
			</div>
		</div>
		  
		 <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if (!empty($model->thumbnail)): ?>
               <button type="button" class="close" aria-hidden="true" id="thumbnail-delete">&times;</button>   
                <?php endif ?>
                <img id="thumbnail" class="media-object" data-src="holder.js/194x194" alt="thumbnail" title="thumbnail" src="<?= (isset($model->thumbnail) && !empty($model->thumbnail))?$model->thumbnail:"data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTMiIGhlaWdodD0iMTkzIj48cmVjdCB3aWR0aD0iMTkzIiBoZWlnaHQ9IjE5MyIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk2IiB5PSI5NiIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxOHB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPnRodW1ibmFpbDwvdGV4dD48L3N2Zz4=" ?>" class="img-rounded" style="max-width:194px;max-height:194px;">
                <input class="ke-input-text" type="text" id="url" value="" readonly="readonly" /> <input type="button" id="uploadButton" value="<?= Yii::t('app', 'Upload') ?>" />
                <?= Html::activeHiddenInput($model, 'thumbnail') ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
            <?= $form->field($model, 'status')->dropDownList(CommonUtility::getDictsList('cms_post_status', 0), [
			'prompt' => '请选择状态',
			'class' => 'form-control',
			'style' => 'width:100%'
		]) ?>
            <?php $model->isNewRecord?$model->published_at=date("Y-m-d H:i:s"):$model->published_at=date("Y-m-d H:i:s", $model->published_at);?>
            <?= $form->field($model, 'published_at')->textInput(['maxlength' => 255]) ?>
            <button id="set-it-now" type="button" class="btn btn-default form-control"><?= Yii::t('app', 'Set It Now') ?></button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
            <?= $form->field($model, 'disallow_comment')->checkBox() ?>
            </div>
        </div>
		<div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
		<?php ActiveForm::end(); ?>
    </div>
</section>

<?php 
$this->registerJs('
jQuery(".panel-body").on("click", "#thumbnail-delete",function(){
    $.get("'.Url::to(['cms_post/thumbnaildelete', 'id' => $model->id]).'", function(data){jQuery("#thumbnail").attr("src", "");})
});
jQuery(".panel-body").on("click", "#set-it-now",function(){ jQuery("#post-published_at").prop("value","'.date('Y-m-d H:i:s').'") });

KindEditor.ready(function(K) {
    var uploadbutton = K.uploadbutton({
        button : K("#uploadButton")[0],
        fieldName : "imgFile",
        url : "'.Url::toRoute('createimgajax').'",
        afterUpload : function(data) {
            if (data.error === 0) {
                var url = K.formatUrl(data.url, "absolute");
                K("#url").val(url);
                K("#thumbnail").attr("src",url);
                K("#post-thumbnail").val(url);
            } else {
                alert(data.message);
            }
        },
        afterError : function(str) {
            alert("自定义错误信息: " + str);
        }
    });
    uploadbutton.fileBox.change(function(e) {
        uploadbutton.submit();
    });
});
');

// for tags
AutoCompleteAsset::register($this);
$this->registerJs('
  $(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#post-tags" )
      // do not navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).data( "ui-autocomplete" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "'.Url::toRoute(['suggest-tags']).'", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 1 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });
');

$this->registerCss("
.ui-autocomplete {
position: absolute;
top: 100%;
left: 0;
z-index: 1000;
display: none;
float: left;
min-width: 160px;
padding: 5px 0;
margin: 2px 0 0;
list-style: none;
font-size: 14px;
background-color: #fff;
border: 1px solid #ccc;
border: 1px solid rgba(0,0,0,.15);
border-radius: 4px;
-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
box-shadow: 0 6px 12px rgba(0,0,0,.175);
background-clip: padding-box;}
 
.ui-menu-item > a.ui-corner-all {
display: block;
padding: 3px 20px;
clear: both;
font-weight: 400;
line-height: 1.42857143;
color: #333;
white-space: nowrap;}
.ui-menu-item > a.ui-corner-all:hover {
text-decoration: none;
color: #262626;
background-color: #f5f5f5;}
");?>