<?php

use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;
use app\common\includes\CommonUtility;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\admin\models\search\SysvariableSearch $searchModel
 */
$this->title='自定义变量';
$this->addBreadcrumb('自定义变量',['sysvariable/index']);
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
			'value:ntext',
			'data_type',
			[
                'attribute' => 'data_type',
                'value' => function ($data) {
                        return CommonUtility::getDataType($data->data_type);
                    }
            ],
			'note',
			// 'is_cache',

			['class' => 'app\modules\admin\components\grid\ActionColumn'],
		],
	]); ?>

</section>
