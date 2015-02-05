<?php

namespace app\modules\cms\actions\content;

use Yii;

use app\common\models\search\ChannelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\common\models\Content;
use yii\web\HttpException;
use app\common\models\DefineModel;
use app\common\models\DefineTable;
use app\common\models\Channel;
use app\common\models\TplForm;
use app\modules\admin\base\BaseBackController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\YGong;
use app\common\models\DefineTableField;
use app\common\contentmodels\CommonContent;
use app\components\helpers\TTimeHelper;
use app\components\base\BaseAction;
use app\components\base\BaseActiveRecord;
use app\components\helpers\TFileHelper;
use app\common\includes\CommonUtility;
use yii\web\UploadedFile;
use app\components\helpers\TStringHelper;

/**
 * ChannelController implements the CRUD actions for Channel model.
 */
class ContentAction extends BaseBackAction
{
	public $currentTableName='model_news4';
	
	public function initContent($model,$currentChannel)
	{
		$tableName = $currentChannel->table;
	
		$locals=[];
		$locals['model']= $model;
		$locals['chnid']=$currentChannel['id'];
		$locals['currentChannel']=$currentChannel;
		$locals['fields']=DefineTableField::findAll(['table'=>$tableName,'is_sys'=>0]);
	
		return $locals;
	}
	
	public function saveContent($model)
	{
		$model->removeSpecialAtt();
		
		$model->user_id=1;
		$model->user_name='admin';
		$model->publish_time=TTimeHelper::getCurrentTime();
		$model->modify_time=TTimeHelper::getCurrentTime();
		$model->title_format=CommonUtility::getTitleFormatValue($model->title_format);
		$model->flag=CommonUtility::getFlagValue($model->flag);

		$uploadedFile = CommonUtility::uploadFile('Content[title_pic]');
		if($uploadedFile!=null)
		{
			$model->title_pic=$uploadedFile['url'].$uploadedFile['new_name'];
		}
		
		if($model->title_pic==null||empty($model->title_pic))
		{
			$model->is_pic=0;
		}
		else
		{
			$model->is_pic=1;
		}
		
		if($model->views==null)
		{
			$model->views=0;
		}
		if($model->commonts==null)
		{
			$model->commonts=0;
		}
		if($model->summary==null||empty($model->summary))
		{
			$content = strip_tags($model->content);
			$pattern = '/\s/';//去除空白
			$content = preg_replace($pattern, '', $content);
			$model->summary=TStringHelper::subStr($content,250);
		}
		
		$command = YGong::createCommand();
		if($model->isNewRecord)
		{
			$command->insert($this->currentTableName, $model);
		}
		else
		{
			$command->update($this->currentTableName, $model,['id'=>$model['id']]);
		}
	
		$command->execute();
	}
	
	protected function findModel($id)
	{
		$sql='select * from '.$this->currentTableName.' where id='.$id;
	
		return YGong::createCommand($sql)->queryOne();
	}
	

	
	public function getTpl($chnId,$tplName)
	{
		$ret = TFileHelper::buildPath(['model_default',$tplName],false);
		
		$cachedChannels = YGong::getAppParam('cachedChannels');
	
		if(isset($cachedChannels[$chnId]))
		{
			$backend = \Yii::getAlias('@backend');
				
			$channelModel= $cachedChannels[$chnId];
				
			$table = $channelModel['table'];
			$tplPath = TFileHelper::buildPath([$backend,'views','content', $table,$tplName.'.php'],false);
			
			if(TFileHelper::exist($tplPath))
			{
				$ret = TFileHelper::buildPath([$table,$tplName],false);
			}
			else 
			{
				YGong::info($tplPath.' does not exist in backend',__METHOD__);
			}
		}
	
		return $ret;
	}
	
	
}
