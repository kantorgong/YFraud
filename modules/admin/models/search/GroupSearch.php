<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ds\Group;

/**
 * GroupSearch represents the model behind the search form about Group.
 */
class GroupSearch extends Model
{
	public $id;
	public $name;
	public $sale;
	public $listorder;
	public $stop_at;
	public $status;
    public $recommend;
	public $extra;
	public $tpl;
	public $tpl_setting;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'listorder', 'stop_at', 'status','recommend', 'created_at', 'updated_at'], 'integer'],
			[['name', 'sale', 'extra', 'tpl', 'tpl_setting'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => '团购ID',
			'name' => '名称',
			'sale' => '优惠信息',
			'listorder' => '排序',
			'stop_at' => '截止报名',
			'status' => '状态',
            'recommend' => '推荐',
			'extra' => '附加信息',
			'tpl' => '模板',
			'tpl_setting' => '模板配置',
			'created_at' => '创建时间',
			'updated_at' => '修改时间',
		];
	}

	public function search($params)
	{
		$query = Group::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ], //设置默认排序是createTime倒序
            ],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'sale', true);
		$this->addCondition($query, 'listorder');
		$this->addCondition($query, 'stop_at');
		$this->addCondition($query, 'status');
        $this->addCondition($query, 'recommend');
		$this->addCondition($query, 'extra', true);
		$this->addCondition($query, 'tpl', true);
		$this->addCondition($query, 'tpl_setting', true);
		$this->addCondition($query, 'created_at');
		$this->addCondition($query, 'updated_at');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
