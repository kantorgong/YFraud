<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\DictSearch $searchModel
 */

$this->title = $parent['name'];
$this->addBreadcrumb('字典分类',['dictcategory/index']);
$this->addBreadcrumb($category['name'].'('.$category['id'].')',['dict/index','catid'=>$category['id']]);
array_pop($parents);
foreach ($parents as $item)
{
	$this->addBreadcrumb($item->name, ['index','pid'=>$item->id,'catid'=>$category['id']]);
}
$this->addBreadcrumb($parent['name']);
?>
<div class="clearfix">
    <h4></h4>
</div>

<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::a('<i class="glyphicon glyphicon-plus"></i> 新建字典项', ['create','pid'=>$pid,'catid'=>$category['id']],[
                    'style' => "background-color:#FF4400;color: #FFF"
                ]); ?></li>
        </ul>
        <i class="fa fa-group"></i> <?= Html::encode($this->title) ?>
    </header>

	<div class="dict-index">

  
	<table width="100%" class="table">
	    <tr class="tb_header">
	      <th width="50px">ID</th>
	      <th width="120px">名称</th>
	      <th >值</th>
	      <th width="80px">排序</th>
	      <th width="200">操作</th>
	    </tr>
		<?php foreach ($rows as $row ): ?>
		<tr>
		<td><?php echo $row['id']?></td>
		<td><?php echo $row['name']?></td>
		<td><?php echo $row['value']?></td>
		<td><?php echo $row['sort_num']?></td>
		<td>
			<?= Html::a('查看子项', ['index', 'pid' => $row->id,'catid'=>$category['id']]) ?>
			<?= Html::a('添加子项', ['create', 'pid' => $row->id,'catid'=>$category['id']]) ?>
			<?= Html::a('编辑', ['update', 'id' => $row->id,'catid'=>$category['id']]) ?>
			<?php echo Html::a('删除', ['delete', 'id' => $row->id,'catid'=>$category['id']], [
				'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
				'data-method' => 'post',
			]); ?>
		</td>
		</tr>
		<?php endforeach;?>
	</table>
    <div class="tbox">
	    <div class="floatRight">
		    <?php echo LinkPager::widget([
		   		'pagination' => $pages,
		   	]);?>
	    </div>
    </div> 	
</div>

</section>
