<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\common\includes\CommonUtility;

/**
 * @var yii\web\View $this
 */

?>
<dl>
        <dt><span><?= date("Y-m-d H:i:s", $model->published_at) ?>  </a></span><?=Html::a(Html::encode($model->title), ['view', 'id' => $model->id], ['target' => '_blank'])?></dt>
        <dd>来源：<?= $model->source?$model->source?Html::a(CommonUtility::getDict('cms_post_source',$model->source)['name'],CommonUtility::getDict('cms_post_source',$model->source)['value']):$model->source:"" ?>&nbsp;&nbsp;&nbsp;&nbsp作者：<?= Html::encode($model->writer?$model->writer:"") ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= $model->tags?"标签：":"" ?><?= implode(', ', $model->tagLinks); ?></dd>
</dl>