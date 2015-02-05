<?php
/**
 * @var yii\web\View $this
 */
//use yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\common\includes\CommonUtility;
use app\widgets\Alert;
use yii\jui\AutoCompleteAsset;

$this->title = '举报诈骗-'.CommonUtility::getConfigValue('site_name');
$view = \app\components\YGong::getView();
$view->registerMetaTag(['name' => 'keywords', 'content' => '诈骗,举报诈骗']);
$view->registerMetaTag(['name' => 'description', 'content' => '举报诈骗信息']);

?>

<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/static/front/css/lanhuwei/release.css">
<script src="<?= Yii::getAlias('@web') ?>/static/front/js/common/jquery-1.9.1.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/admin/js/cxselect/jquery.cxselect.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/static/front/js/lanhuwei/release.js"></script>


<script type="text/javascript" src="<?= Yii::getAlias('@web') ?>/static/My97DatePicker/WdatePicker.js"></script>


<!-- 发布页开始 -->
<?php $form = ActiveForm::begin([
    'errorCssClass' => 'error',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
<div class="release frameDiv clearfix">
    <?= Alert::widget() ?>
    <dl>
        <dt><span>*</span>标题：</dt>
        <dd>
            <?= $form->field($model, 'fraud_info_title')->textInput(['class' => 'rtxt txt2','maxlength' => 200])->label('') ?>
        </dd>
    </dl>
    <dl>
        <dt><span>*</span>被骗地点：</dt>
        <dd>
            <div id="city_china">
                <select class="province form-control" style="80px;" data-value="河南省" disabled="disabled" name="Fraudinfo[fraud_info_province]"></select>
                <select class="city  form-control" style="50px" data-value="郑州市" disabled="disabled" name="Fraudinfo[fraud_info_city]"></select>
                <select class="area  form-control" style="50px" data-value="金水区" disabled="disabled" name="Fraudinfo[fraud_info_area]"></select>
                <input type="text" id="fraudinfo-fraud_info_address" class="rtxt txt2" name="Fraudinfo[fraud_info_address]" maxlength="200" placeholder="街道地址">
            </div>
            <script>
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
            </script>
        </dd>
    </dl>
    <dl>
        <dt><span>*</span>诈骗类型：</dt>
        <dd>
            <?php
            $arrFraudType = CommonUtility::getDictsList('fraud_type', 0);
            $strFraudType = '';
            $type_k = 1;
            foreach($arrFraudType as $key=>$type)
            {
                $strCheck = $type_k == 1 ? 'checked' : '';
                $strFraudType .= '<label class="tab_zplx">'
                              .     '<input type="radio" value="'.$key.'" name="fraudtype" '.$strCheck.' /> '.$arrFraudType[$key]
                              . '诈骗</label>';
                $type_k++;
            }
            echo $strFraudType;
            ?>
        </dd>
    </dl>
    <dl>
        <dt><span>*</span>诈骗介质：</dt>
        <dd>
            <?php
            $arrFraudMedium = CommonUtility::getDictsList('fraud_medium', 0);
            $strFraudMedium = '';
            $strFraudContent = '';
            $medium_k = 1;
            foreach($arrFraudMedium as $key=>$type)
            {
                $strCheck = $medium_k == 1 ? 'checked' : '';
                $strFraudMedium .= '<label class="tab_zp">'
                                .     '<input type="checkbox" value="'.$key.'" name="fraudmedium" '.$strCheck.' /> '.$arrFraudMedium[$key]
                                 . '</label>';

                $strFraud_medium_content .= '<div class="tab_zp_ct">'
                    .      '<div class="label1">'
                    .          '<span class="name1">诈骗'.$arrFraudMedium[$key].'：</span>'
                    .          '<input type="text" name="medium_content_'.$key.'[]" class="txt_zp" />'
                    .          '<a href="javascript:;" class="btn_zj">增加</a>'
                    .          '<a href="javascript:;" class="btn_sc">删除</a>'
                    .'     </div>'
                    .'</div>';
                $medium_k++;
            }
            echo $strFraudMedium;
            ?>
        </dd>
    </dl>
    <dl>
        <dt>&nbsp;</dt>
        <dd>
            <?=$strFraud_medium_content?>
        </dd>
    </dl>
    <dl>
        <dt><span>*</span>诈骗时间：</dt>
        <dd>
            <?php if($model->isNewRecord){$model->fraud_info_time=Date('Y-m-d,H:m:s');} echo $form->field($model, 'fraud_info_time',['options'=>[]])->textInput(['width'=>'200px','class' => 'rtxt Wdate','onclick' =>'WdatePicker({skin:"default",dateFmt:"yyyy-MM-dd HH:mm:ss"})'])->label(''); ?></dd>
    </dl>
<!--    <dl>-->
<!--        <dt>上传附件：</dt>-->
<!--        <dd>-->
<!--            <div class="file-box">-->

<!--            </div>-->
<!--        </dd>-->
<!--    </dl>-->
    <dl>
        <dt>被骗详情：</dt>
        <dd>
            <?=\djfly\kindeditor\KindEditor::widget([
                'id' => 'page-content',
                'model' => $model,
                'attribute' => 'fraud_info_content',
                'items' => [
                    'langType' => Yii::$app->language=="zh-CN"?"zh_CN":Yii::$app->language,
                    'height' => '350px',
                    'themeType' => 'simple',
                    'pagebreakHtml' => Yii::$app->params['pagebreakHtml'],
                    'allowImageUpload' => true,
                    'allowFileManager' => true,
                    'uploadJson' => Url::toRoute('createimgajax'),
                    'fileManagerJson' => Url::toRoute('post/filemanager'),
                    'items' => [
                        'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                        'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                        'insertunorderedlist', '|', 'emoticons', 'image', 'link',
                    ]
                ],
            ])?>
            <?= $form->field($model, 'fraud_info_content', ['template'=>'{input}'])->textarea(['rows' => 6,'cols' =>80]) ?>

        </dd>
    </dl>
    <dl>
        <dt>标签：</dt>
        <dd>
<!--            <ul id="tagText">-->
<!--                <li>标签<a href="javascript:;">X</a></li>-->
<!--            </ul>-->
            <?= $form->field($model, 'fraud_info_tags')->textInput(['class' => 'rtxt','maxlength' => 300,'placeholder' => '请输入你的标签'])->label('') ?>
        </dd>
    </dl>
    <dl>
        <dt></dt>
        <dd style="margin-left: 250px">

            <input type="hidden" name="Fraudinfo[fraud_info_iscryptonym]" value="0">匿名：
            <input type="checkbox" id="fraudinfo-fraud_info_iscryptonym" name="Fraudinfo[fraud_info_iscryptonym]" value="1" 0="匿名">
            &nbsp;&nbsp;
            <?= Html::submitButton( '发 布', ['class' =>  'btn']) ?>

        </dd>
    </dl>
    <dl>
        <dt>&nbsp;</dt>
        <dd>

        </dd>
    </dl>
</div>
<?php ActiveForm::end(); ?>
<!-- 发布页结束 -->




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