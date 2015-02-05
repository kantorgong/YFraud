<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "app\\modules\\admin\\components\\grid\\GridView" : "yii\\widgets\\ListView" ?>;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var <?= ltrim($generator->searchModelClass, '\\') ?> $searchModel
 */
?>
<div class="clearfix">
    <h4></h4>
</div>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?php echo "<?= Html::a('<i class=\"glyphicon glyphicon-plus\"></i> 添加', ['create'],[

                    'style' => \"background-color:#FF4400;color: #FFF\"
                ]); ?>" ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= "<?= " ?>Html::encode($this->title) ?>
    </header>

<?php if ($generator->indexWidgetType === 'grid'): ?>
	<?= "<?php " ?>echo GridView::widget([
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
	foreach ($generator->getColumnNames() as $name) {
		if (++$count < 6) {
			echo "\t\t\t'" . $name . "',\n";
		} else {
			echo "\t\t\t// '" . $name . "',\n";
		}
	}
} else {
	foreach ($tableSchema->columns as $column) {
		$format = $generator->generateColumnFormat($column);
		if (++$count < 6) {
			echo "\t\t\t'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
		} else {
			echo "\t\t\t// '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
		}
	}
}
?>

			['class' => 'app\modules\admin\components\grid\ActionColumn'],
		],
	]); ?>
<?php else: ?>
	<?= "<?php " ?>echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemOptions' => ['class' => 'item'],
		'itemView' => function ($model, $key, $index, $widget) {
			return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
		},
	]); ?>
<?php endif; ?>

</section>
