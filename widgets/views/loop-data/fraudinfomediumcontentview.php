<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\components\helper\TTimeHelper;
use app\common\includes\UrlUtility;
use app\components\helper\TStringHelper;
use app\common\includes\CommonUtility;

?>

<dl>
    <dt>相关<?=CommonUtility::getDict('fraud_medium',$row['fraud_medium'])['name']?>：</dt>
    <dd><?=$row['medium_content']?></dd>
</dl>