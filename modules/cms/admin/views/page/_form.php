<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\widgets\Tabs;
use yii\web\View;
use app\modules\admin\views\AdminAsset;
use yii\jui\AutoCompleteAsset;

AdminAsset::register($this);
/**
 * @var yii\web\View $this
 * @var app\models\Page $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJsFile(Yii::getAlias('@web') . '/admin/js/jquery.js',['position' => View::POS_HEAD]);

?>

<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode(Yii::t('app', '页面')) ?>
    </header>

    <div class="panel-body">
        <div class="col-md-6" >
            <?php
            $disabled = $model->isNewRecord ? null : 'disabled';
            $form = ActiveForm::begin([
                'fieldConfig' => $this->getDefaultFieldConfig(),
            ]);
            ?>
            <div class="post-form" class="form-horizontal"">

            <?php
            Tabs::begin([
                'items' => [
                    ['label' => '基本信息', 'contentId' => 'tableBasic'],
                    ['label' => 'SEO信息', 'contentId' => 'tableExt'],
                ],
            ]);
            ?>

            <div id="tableBasic" class="tab-pane active">

                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
                <?=\djfly\kindeditor\KindEditor::widget([
                    'id' => 'page-content',
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

                <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            </div>

            <div id="tableExt" class="tab-pane">

                <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'seo_description')->textArea(['rows' => 5]) ?>

            </div>

            <?php Tabs::end();?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>


</section>


<?php
$this->registerJs('
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

?>