<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\common\includes\CommonUtility;
use app\common\models\Channel;

/**
 * @var yii\web\View $this
 * @var app\models\Post $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="fa fa-mail-reply"></i> 返回', Url::to(['index'])) ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=> Yii::t('app', 'Category'),
                'value'=>Channel::getChannel($model->category_id)['name'],
            ],
            'title',
            [
                'label'=> Yii::t('app', 'Type'),
                'value'=>CommonUtility::getDict('cms_post_type',$model->type)['name'],
            ],
            'thumbnail',
            'url:url',
            'summary',
            [
                'label'=> Yii::t('app', 'Source'),
                'value'=>CommonUtility::getDict('cms_post_source',$model->source)['name'],
            ],
            'writer',
            'content:ntext',
            'tags',
            'seo_title',
            'seo_keywords',
            'seo_description',
            [
                'label'=> Yii::t('app', 'Published At'),
                'value'=>date('Y-m-d H:m:s',$model->published_at),
            ],
            'views',
            'likes',
            'comment_count',
            'disallow_comment',
            [
                'label'=> Yii::t('app', 'Status'),
                'value'=>CommonUtility::getDict('cms_post_status',$model->status)['name'],
            ],
            [
                'label'=> Yii::t('app', 'Created At'),
                'value'=>date('Y-m-d H:m:s',$model->created_at),
            ],
            [
                'label'=> Yii::t('app', 'Updated At'),
                'value'=>date('Y-m-d H:m:s',$model->updated_at),
            ],
        ],
    ]) ?>

</section>


