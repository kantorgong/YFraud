<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\common\includes\UrlUtility;
use app\common\includes\CommonUtility;
use app\components\helper\TStringHelper;

?>

<li class="first">
    <a href="<?= Url::to(['post/view', 'id' => $row['id']]) ?>" target="_blank"><img src="<?php echo CommonUtility::getTitlePic($row)?>" alt="<?php echo $row['title']?>" />
        <span><?php echo TStringHelper::subStr($row['title'],$length)?></a>
    <p><?php echo TStringHelper::subStr($row['summary'], 60);?></span></p>
</li>
