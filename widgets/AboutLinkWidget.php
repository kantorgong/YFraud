<?php

namespace app\widgets;

use app\models\Link;
use yii\helpers\Url;
use yii\helpers\Html;
use app\common\models\Page;
use app\common\models\search\PageSearch;

class AboutLinkWidget extends \yii\bootstrap\Widget
{
    public $max=10;
	public function init()
	{
		parent::init();
        $pages=Page::find()->all();
        $i = 0;
        $link ='';
        foreach($pages as $key=>$value)
        {
            //$menuItems[] = ['label' => $value->title, 'url' => ['page/view', 'name' => $value->name]];
            if($i == 0)
            {
                $link .= Html::a(Html::encode($value->title), ['page/view', 'name' => $value->name]);
            }
            else
            {
                $link .= ' 丨 '.Html::a(Html::encode($value->title), ['page/view', 'name' => $value->name]);
            }

            $i++;
        }
		echo $link;
	}
}