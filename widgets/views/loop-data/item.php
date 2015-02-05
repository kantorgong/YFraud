<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\components\helper\TTimeHelper;
use app\common\includes\UrlUtility;
use app\components\helper\TStringHelper;

?>
<dl>
    <dt><span><?php TTimeHelper::showTime($row['published_at'])?></span> <a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank"><?php echo TStringHelper::subStr($row['title'],$length)?></a></dt>
    <dd class="txt"><?php echo TStringHelper::subStr($row['summary'], 60);?> <a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank">[阅读全文]</a></dd>
<!--    <dd class="info"><a href="#" target="_blank">顶 213</a>  <a href="#" target="_blank">踩 256</a>   <a href="#" target="_blank">留言0</a></dd>-->
</dl>