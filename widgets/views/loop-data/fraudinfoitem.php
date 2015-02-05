<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\components\helper\TTimeHelper;
use app\common\includes\UrlUtility;
use app\components\helper\TStringHelper;
use app\common\includes\DataSource;
use app\components\widgets\LoopData;

$fragmentData = DataSource::getFraudmdediumByid($row['fraud_info_id'], ['limit'=>10]);
?>
<dl>
    <dt><span><?=$row['fraud_info_time']?></span> <a href="<?= Url::to(['fraudinfo/view', 'id' => $row['fraud_info_id']]) ?>" target="_blank"><?php echo TStringHelper::subStr($row['fraud_info_title'],$length)?></a></dt>
    <dd class="txt">
        <p>诈骗地点：<?= $row['fraud_info_province'].'&nbsp;'.$row['fraud_info_city'].'&nbsp;'.$row['fraud_info_area'].'&nbsp;'.$row['fraud_info_address'] ?></p>
        <p>诈骗介质：<?php echo LoopData::widget(['dataSource'=>$fragmentData,'item'=>'fraudinfomediumcontent','length'=>30]);?>
        </p>
    </dd>
    <dd class="txt"><?php echo TStringHelper::subStr($row['fraud_info_depict'], 60);?> <a href="<?= Url::to(['fraudinfo/view', 'id' => $row['fraud_info_id']]) ?>" target="_blank">[阅读全文]</a></dd>
</dl>