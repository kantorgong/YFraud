<?php

namespace app\modules\admin\base;

use Yii;
use app\components\base\BaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BaseBackController extends BaseController
{
	 protected  $_viewPaht;

    public $layout = 'main';


    public function getViewPath() {

        if($this->_viewPaht == null)
            return parent::getViewPath();

        return $this->_viewPaht;
    }

    public function setViewPath($path) {
        $this->_viewPaht = $path;
    }
	
	
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'except'=>['login'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}
	
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
}