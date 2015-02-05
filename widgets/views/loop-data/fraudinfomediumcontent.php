<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\components\helper\TTimeHelper;
use app\common\includes\UrlUtility;
use app\components\helper\TStringHelper;
use app\common\includes\CommonUtility;

?>
<?php
$str = '';
if($_POST['medium_content'] == $row['medium_content'])
{
    $str = '<span style="color:red">'.$row['medium_content'].'</span>';
}
else
{
    $str = $row['medium_content'];
}
echo CommonUtility::getDict('fraud_medium',$row['fraud_medium'])['name'].':'.$str.' ';
?>