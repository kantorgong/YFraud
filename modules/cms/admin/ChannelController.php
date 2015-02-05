<?php

namespace app\modules\cms\admin;

use Yii;
use app\common\models\Channel;
use yii\web\NotFoundHttpException;
use app\common\models\DefineTable;
use app\modules\admin\base\BaseBackController;
use app\common\includes\CacheUtility;
use app\common\includes\CommonUtility;
use app\components\YGong;

/**
 * ChannelController implements the CRUD actions for Channel model.
 */
class ChannelController extends BaseBackController
{

	public function actionIndex()
	{
		$locals = [];
		
		return $this->render('index', $locals);
	}

	public function actionView($id)
	{
		return $this->render('view', ['model' => $this->findModel($id)]);
	}

	private function getTpl($prefix)
	{
		$ret = [];
		
		$fiels = CommonUtility::getFrontViews(['content', 'model_default'], $prefix);
		foreach($fiels as $file)
		{
			$ret[] = ['name' => $file, 'table' => '默认模板(model_default)'];
		}
		
		$tables = DefineTable::getAllTables();
		foreach($tables as $table)
		{
			$fiels = CommonUtility::getFrontViews(['content', $table['id']], $prefix);
			foreach($fiels as $file)
			{
				$ret[] = ['name' => $file, 'table' =>$table['name_cn'].'('. $table.')'];
			}
		}
		return $ret;
	}

	public function actionCreate()
	{
		$model = new Channel();
		
		if($model->load($_POST) && $model->save())
		{
			CacheUtility::createChannelCache();
			
			return $this->redirect(['index']);
		}
		else
		{
			$locals = [];
			$locals['model'] = $model;
			$locals['tableList'] = DefineTable::getAllTables();
			$locals['channelTpls'] = $this->getTpl('channel_');
			$locals['listTpls'] = $this->getTpl('list_');
			$locals['detailTpls'] = $this->getTpl('detail_');
			
			return $this->render('create', $locals);
		}
	}

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		
		if($model->load($_POST))
		{
			$parentIds = Channel::getParentIds($model['parent_id']);
			
			if(in_array($model['id'], $parentIds))
			{
				YGong::setErrorMessage('不能设置父节点为当前节点的子节点');
				return $this->redirect(['update', 'id' => $id]);
			}
			
			$model->save();
			
			CacheUtility::createChannelCache();
			
			return $this->redirect(['index']);
		}
		else
		{
			$locals = [];
			$locals['model'] = $model;
			$locals['tableList'] = DefineTable::getAllTables();
			$locals['channelTpls'] = $this->getTpl('channel_');
			$locals['listTpls'] = $this->getTpl('list_');
			$locals['detailTpls'] = $this->getTpl('detail_');
			
			return $this->render('update', $locals);
		}
	}

	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		CacheUtility::createChannelCache();
		
		return $this->redirect(['index']);
	}

	protected function findModel($id)
	{
		if(($model = Channel::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
