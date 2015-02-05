<?php

namespace app\modules\cms\actions\content\model_default;

use Yii;

use app\components\YGong;
use app\common\models\Channel;
use app\common\models\content\CommonContent;
use app\modules\cms\actions\content\ContentAction;


class CreateAction extends ContentAction
{
	public function run($chnid)
	{	
		$currentChannel=Channel::findOne($chnid);
		$this->currentTableName = $currentChannel['table'];
		
		$model = new CommonContent($currentChannel['table']);
		$model->setIsNewRecord(true);
		
		if ($model->load($_POST)) {
				
			$this->saveContent($model,true);
				
			return $this->redirect(['index', 'chnid' => $chnid]);
		} else {
			$locals = $this->initContent($model,$currentChannel);
		
			$tplName = $this->getTpl($chnid, 'create');
			
			return $this->render($tplName, $locals);
		}
	}
	

}
