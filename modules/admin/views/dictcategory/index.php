<?php

use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\admin\models\search\DictcategorySearch $searchModel
 */
$this->title='数据字典';
$this->addBreadcrumb('数据字典',['dictcategory/index']);
?>
<div class="clearfix">
    <h4></h4>
</div>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="glyphicon glyphicon-plus"></i> 添加', ['create'],[

                    'style' => "background-color:#FF4400;color: #FFF"
                ]); ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'name',
			'note',
			[
                'attribute' => 'is_sys',
                'value' => function ($data) {
                        return ($data->is_sys) ? '是' : '否';
                    }
            ],
			[
                'class' => 'app\modules\admin\components\grid\ActionColumn',
                'template' => '{dict} {update} {delete}',
                'headerOptions' => [
                    'style' => 'text-align: center; width:400px;'
                ],
				'header'=>'操作', 
                'buttons' => [
                    'dict' => function ($url, $model) {
                            return Html::a('<span class="fa fa-list inline"></span> 查看数据',['dict/index', 'catid' =>$model->id], [
                                'title' => Yii::t('yii', '查看数据'),
                                'style' => 'padding:0px 2px;white-space:nowrap; '
                            ]).Html::a('<span class="fa fa-plus-circle"></span> 增加数据', ['dict/create', 'catid' =>$model->id], [
                                'title' => Yii::t('yii', '增加数据'),
                                'style' => 'padding:0px 2px;white-space:nowrap; '
                            ]);
                        }
                ]
            ],
		],
		
	]); ?>
</section>
