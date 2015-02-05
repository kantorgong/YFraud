<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\admin\Menu;

/**
 * MenuSearch represents the model behind the search form about Menu.
 */
class MenuSearch extends Model
{
	public $id;
	public $name;
	public $icon;
	public $parentid;
	public $controller;
	public $action;
	public $description;
	public $listorder;
	public $display;

	public function rules()
	{
		return [
			[['id', 'parentid', 'listorder', 'display'], 'integer'],
			[['name', 'icon', 'controller', 'action', 'description'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => '菜单ID',
			'name' => '菜单名',
			'icon' => '图标',
			'parentid' => '上级菜单ID',
			'controller' => '控制器',
			'action' => '动作',
			'description' => 'Description',
			'listorder' => '排序',
			'display' => '是否显示',
		];
	}

	public function search($params)
	{
		$query = Menu::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'icon', true);
		$this->addCondition($query, 'parentid');
		$this->addCondition($query, 'controller', true);
		$this->addCondition($query, 'action', true);
		$this->addCondition($query, 'description', true);
		$this->addCondition($query, 'listorder');
		$this->addCondition($query, 'display');
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
