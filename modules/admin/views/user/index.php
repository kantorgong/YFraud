<?php

use yii\helpers\Html;
use app\modules\admin\components\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\UserSearch $searchModel
 */

?>
<div class="clearfix">
    <h4></h4>
</div>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="glyphicon glyphicon-plus"></i> 添加', ['create'], [

                    'style' => "background-color:#FF4400;color: #FFF"
                ]) ?></li>
        </ul>
        <i class="fa fa-user"></i> 用户列表
    </header>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'id',
                'headerOptions' => [
                    'style' => 'width:100px',

                ],
            ],
            'username',
            'name',

            [
                'attribute' => 'role_id',
                'value' => function ($data) {
                    return $data->role->name;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return ($data->status) ? '否' : '是';
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'app\modules\admin\components\grid\ActionColumn'],
        ],
    ]); ?>
</section>
