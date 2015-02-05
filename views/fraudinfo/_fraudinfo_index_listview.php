<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\common\includes\CommonUtility;
use app\common\includes\DataSource;
use app\components\widgets\LoopData;
/**
 * @var yii\web\View $this
 */
$fragmentData = DataSource::getFraudmdediumByid($model->fraud_info_id, ['limit'=>10]);
?>
<?php
if($model->fraud_info_nickname == 'robot')
{
    $model->fraud_info_nickname ='游客';
}
?>
<dl>
        <dt><span><?= $model->fraud_info_systime ?>  </span><?=Html::a(Html::encode($model['fraud_info_title']), ['view', 'id' => $model->fraud_info_id], ['target' => '_blank'])?></dt>
        <dd>诈骗地点：<?= $model->fraud_info_province.'&nbsp;'.$model->fraud_info_city.'&nbsp;'.$model->fraud_info_area.'&nbsp;'.$model->fraud_info_address ?>&nbsp;&nbsp;&nbsp;&nbsp举报网友：<?= $model->fraud_info_iscryptonym==0?Html::encode($model->fraud_info_nickname):'匿名' ?>&nbsp;&nbsp;&nbsp;&nbsp;介质：<?=LoopData::widget(['dataSource'=>$fragmentData,'item'=>'fraudinfomediumcontent','length'=>30])?></dd>
</dl>