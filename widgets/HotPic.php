<?php

namespace app\widgets;

use app\models\Post;
use yii\helpers\Url;
use yii\helpers\Html;
use app\common\includes\UrlUtility;
use app\common\includes\CommonUtility;
use app\components\helper\TStringHelper;

class HotPic extends \yii\bootstrap\Widget
{
	public $max=6;
	public function init()
	{
		parent::init();
        $strHtml='';
		$hots = Post::find()->where('status=86')->orderBy(['views' => SORT_DESC])->limit($this->max)->all();
		foreach($hots as $key=>$value)
		{
            $strHtml .= '<li><a href="'. Url::to(['post/view', 'id' => $value->id]).'" target="_blank"><img src="'.CommonUtility::getTitlePic($value).'" alt="'.$value->title.'" />
        '.TStringHelper::subStr($value->title,30).'</a></li>';
		}
        echo $strHtml;
	}
}