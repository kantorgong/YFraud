<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\components\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\MenuSearch $searchModel
 */
?>
<div class="clearfix">
    <h4></h4>
</div>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?=
                Html::a('<i class="glyphicon glyphicon-plus"></i> 添加', ['create'], [

                    'style' => "background-color:#FF4400;color: #FFF"
                ]); ?></li>
        </ul>
        <i class="fa fa-bars"></i> 菜单管理
    </header>

        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()); ?>
        <table class="table table-striped m-b-none dataTable">
            <thead>
            <tr>
                <th>排序</th>
                <th>菜单名</th>
                <th>显示</th>
                <th>链接</th>

                <th style="text-align: center; width:150px;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?= $lists ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    <?= Html::button('排序', ['class' => 'btn btn-primary','id'=>'orderBtn']) ?>
                </td>
            </tr>
            </tfoot>
        </table>

</section>
<script language="javascript">
    <?php
    ob_start();
    ?>


    $("#orderBtn").click(function () {


        var formdata = {'<?= Yii::$app->request->csrfParam?>':'<?=Yii::$app->request->getCsrfToken()?>','listorders':{}};

        $('.listorders').each(function(i,input){
            formdata.listorders[$(input).attr('vid')] = $(input).val();
        });
        $.post('<?= Url::to(['listorder']); ?>', formdata, function (data) {

                alert(data.info);
           if (data.status) {
                window.location.reload();
            }
        }, "json");
        return false;
    });
    <?php
    $js = ob_get_clean();
    $this->registerJs($js);
    ?>
</script>
