<?php

use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\vpn\models\search\NasSearch $searchModel
 */
$this->title = 'NAS设备管理';
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

			'id',
			'nasname',
			'shortname',
			//'type',
			'ports',
			//'secret',
			// 'server',
			// 'community',
			 'description',
			// 'username',
			// 'password',

			['class' => 'app\modules\admin\components\grid\ActionColumn'],
		],
	]); ?>

</section>
