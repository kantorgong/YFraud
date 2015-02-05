<?php

use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\fraud\admin\search\FraudinfoSearch $searchModel
 */
$this->title='诈骗信息';
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
			'fraud_info_id',
			'fraud_info_title',
			'fraud_type_id',
			'fraud_info_time:datetime',
			'fraud_info_systime:datetime',
			// 'fraud_info_province',
			// 'fraud_info_city',
			// 'fraud_info_area',
			// 'fraud_info_userid',
			// 'fraud_info_nickname',
			// 'fraud_info_iscryptonym',
			// 'fraud_info_tags',
			// 'fraud_info_ip',
			// 'fraud_info_content:ntext',
			// 'fraud_info_status',
			// 'fraud_info_numtype',
			// 'fraud_info_num:ntext',
			// 'fraud_info_depict:ntext',
			// 'fraud_info_views',

			['class' => 'app\modules\admin\components\grid\ActionColumn'],
		],
	]); ?>

</section>
