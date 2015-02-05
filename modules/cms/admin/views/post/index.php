<?php

use yii\helpers\Html;
use app\common\includes\CommonUtility;
use app\modules\admin\components\grid\GridView;
use app\common\models\Channel;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\PostSearch $searchModel
 */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'category_id',
			 [
                'attribute'=>'category_id',
                'value' => function ($data) {
                   return Channel::getChannel($data['category_id'])['name'];
                },
               //'filter' => CommonUtility::getDictsList('cms_post_type', 0),
            ],
            'title',
            [
                'attribute'=>'type',
                'value' => function ($data) {
                   return CommonUtility::getDict('cms_post_type',$data['type'])['name'];
                },
               'filter' => CommonUtility::getDictsList('cms_post_type', 0),
            ],
            'published_at:date',
            'views',
            [
                'attribute'=>'status',
                'value' => function ($data) {
                 return CommonUtility::getDict('cms_post_status',$data['status'])['name'];
                },
                'filter' => CommonUtility::getDictsList('cms_post_status', 0),
            ],

			 ['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</section>

