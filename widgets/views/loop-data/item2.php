<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\components\helper\TTimeHelper;
use app\common\includes\UrlUtility;
use app\components\helper\TStringHelper;

?>
<li><span><?php TTimeHelper::showTime($row['published_at'])?></span> <a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank"><?php echo TStringHelper::subStr($row['title'],$length)?></a></li>