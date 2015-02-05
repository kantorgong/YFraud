<?php

namespace app\modules\cms\actions\content\model_default;

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
use app\modules\cms\actions\content\ContentAction;
use app\common\includes\DataSource;
use yii\db\Query;

/**
 * ChannelController implements the CRUD actions for Channel model.
 */
class IndexAction extends ContentAction
{
	public function run($chnid=0)
	{
		if($chnid===0)
		{
			$currentChannel=new Channel;
			$rows=[];
		}
		else
		{
			$currentChannel=Channel::findOne($chnid);
			
			$rows=DataSource::getContentByChannel($chnid);
		}
		
		$query = new Query();
		$query->select('*')
			->from($currentChannel['table'])
			->where(['channel_id'=>$chnid]);
		
		$locals = YGong::getPagedRows($query,['order'=>'publish_time desc']);
		//$locals['rows']=$rows;
		$locals['chnid']=$chnid;
		$locals['channelArrayTree']=Channel::getChannelArrayTree();
		$locals['currentChannel']=$currentChannel;
		
		$tplName = $this->getTpl($chnid, 'index');
		
		return $this->render($tplName, $locals);
	}
	
}
