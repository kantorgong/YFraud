<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var common\models\admin\Role $model
 * @var yii\widgets\ActiveForm $form
 */

$this->title = $model->name . ' 分配权限';
$this->registerJsFile(Yii::getAlias('@web') . '/admin/js/zTree/jquery.ztree.all-3.5.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web') . '/admin/js/zTree/zTreeStyle.css');
?>

<div class="clearfix">
    <h4></h4>
</div>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>
    <div class="panel-body">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin([
                'id' => 'role-priv-form',

            ]); ?>
            <ul id="treeDemo" class="ztree"></ul>
            <div class="form-group">
                <input type="button" id="btnSub" class="btn btn-primary" value="提交">
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<script language="JavaScript">
    var setting = {
        check: {
            enable: true,
            chkboxType: {"Y": "ps", "N": "ps"}
        },
        data: {
            simpleData: {
                enable: true
            }
        }
    };
    var zNodes = <?php echo json_encode($menus); ?>;
    <?php
   ob_start();
   ?>
    var csrfToken = $("input[name='_csrf']").val()
    var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    $('#btnSub').click(function() {
        nodes = treeObj.getCheckedNodes(true);
        if (nodes.length > 0) {
            var menus = {"menu_id": [],"_csrf":csrfToken};
            $.each(nodes, function(i, n) {
                menus.menu_id[i] = n.id;
            });
            $.post("<?= Yii::$app->getRequest()->getUrl(); ?>", menus,
                function(data) {
                    if (!data.status)
                        alert(data.info);
                    else if (data.status) {
                        alert(data.info);
                        window.location.reload();
                    }
                }, "json");
        } else {
            alert('请选择节点！');
        }
        return false;
    });

    <?php
        $js = ob_get_clean();
        $this->registerJs($js);
        ?>
</script>