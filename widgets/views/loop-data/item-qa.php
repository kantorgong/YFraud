<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\components\helper\TTimeHelper;
use app\common\includes\UrlUtility;
use app\components\helper\TStringHelper;

?>
<dl class="fw_wenda">
    <dt><a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank"><span>问</span><?php echo TStringHelper::subStr($row['title'],$length)?></a></dt>
    <dd><a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank"><span>答</span><?php echo TStringHelper::subStr($row['summary'],$length)?></a></dd>
</dl>