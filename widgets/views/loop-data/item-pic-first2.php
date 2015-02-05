<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\common\includes\UrlUtility;
use app\common\includes\CommonUtility;
use app\components\helper\TStringHelper;

?>
<dt><a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank"><?php echo TStringHelper::subStr($row['title'],$length)?></a></dt>
<dd class="img"><a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank"><img src="<?php echo CommonUtility::getTitlePic($row)?>" alt="<?php echo $row['title'];?>" /></a></dd>
<dd class="txt"><?php echo TStringHelper::subStr($row['summary'], 60);?></dd>