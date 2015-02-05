<?php

use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\admin\models\search\LinkageSearch $searchModel
 */
?>
<div class="clearfix">
    <h4></h4>
</div>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <?php
            $addUrl = ['create'];
            if ($searchModel->keyid || $searchModel->parentid):
                $url = ['index'];
                $addUrl['keyid'] = $searchModel->keyid;

                if ($searchModel->parentid) {
                    $addUrl['parentid'] = $searchModel->parentid;
                    $url['LinkageSearch']['keyid'] = $searchModel->keyid;
                    $url['LinkageSearch']['parentid'] = \app\modules\admin\models\Linkage::find()->where(['id' => $searchModel->parentid])->select('parentid')->one()->parentid;
                }
                ?>
                <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回上级', $url); ?></li>
            <?php endif; ?>
            <li><?=
                Html::a('<i class="glyphicon glyphicon-plus"></i> 添加', $addUrl, [

                    'style' => "background-color:#FF4400;color: #FFF"
                ]); ?></li>

        </ul>
        <i class="fa fa-group"></i> 数据字典
    </header>

    <?php
    if ($searchModel->keyid) {
        $columns = [
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'style' => 'text-align: center; width:60px;'
                ],
            ],
            [
                'attribute' => 'listorder',
                'headerOptions' => [
                    'style' => 'text-align: center; width:80px;'
                ],
            ],
            'name',
            [
                'class' => 'app\modules\admin\components\grid\ActionColumn',
                'template' => '{priv} {update} {delete}',
                'headerOptions' => [
                    'style' => 'text-align: center; width:200px;'
                ],
                'buttons' => [
                    'priv' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> 子级',
                                \yii\helpers\Url::to(['index', 'LinkageSearch' => ['keyid' => $model->keyid, 'parentid' => $model->id]]),
                                [
                                    'title' => Yii::t('yii', 'View'),
                                    'style' => 'padding:0px 2px;white-space:nowrap; '
                                ]);
                        }
                ]
            ],
        ];
    } else {
        $columns = [

            [
                'attribute' => 'id',
                'headerOptions' => [
                    'style' => 'text-align: center; width:60px;'
                ],
            ],
            [
                'attribute' => 'listorder',
                'headerOptions' => [
                    'style' => 'text-align: center; width:80px;'
                ],
            ],
            'name',

            [
                'class' => 'app\modules\admin\components\grid\ActionColumn',
                'template' => '{priv} {cache} {update} {delete}',
                'headerOptions' => [
                    'style' => 'text-align: center; width:250px;'
                ],
                'buttons' => [
                    'priv' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> 数据',
                                \yii\helpers\Url::to(['index', 'LinkageSearch' => ['keyid' => $model->id, 'parentid' => 0]]),
                                [
                                    'title' => Yii::t('yii', 'View'),
                                    'style' => 'padding:0px 2px;white-space:nowrap; '
                                ]);
                        },
                    'cache' => function($url,$model) {
                            return Html::a('<span class="glyphicon glyphicon-retweet"></span> 更新缓存',
                                \yii\helpers\Url::to(['cache','id'=>$model->id]),[
                                    'title' => Yii::t('yii', 'View'),
                                    'style' => 'padding:0px 2px;white-space:nowrap; '
                                ]);
                        }
                ]
            ],
        ];
    }

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns

    ]); ?>

</section>
