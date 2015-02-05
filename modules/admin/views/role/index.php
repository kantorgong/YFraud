<?php

use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\RoleSearch $searchModel
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
        <i class="fa fa-group"></i> 角色管理
    </header>

    <?php echo GridView::widget([

        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'id',
                'headerOptions' => [
                    'style' => 'text-align: center; width:60px;'
                ],
            ],
            'name',
            [
                'attribute' => 'disabled',
                'value' => function ($data) {
                        return ($data->disabled) ? '否' : '是';
                    }
            ],
            [
                'class' => 'app\modules\admin\components\grid\ActionColumn',
                'template' => '{priv} {update} {delete}',
                'headerOptions' => [
                    'style' => 'text-align: center; width:200px;'
                ],
                'buttons' => [
                    'priv' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> 权限', $url, [
                                'title' => Yii::t('yii', 'View'),
                                'style' => 'padding:0px 2px;white-space:nowrap; '
                            ]);
                        }
                ]
            ],
        ],
    ]); ?>

</section>
