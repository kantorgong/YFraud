<?php

namespace app\modules\admin\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\User;

/**
 * UserSearch represents the model behind the search form about User.
 */
class UserSearch extends Model
{
	public $id;
	public $username;
	public $password;
	public $name;
	public $encrypt;
	public $role_id;
	public $status;
	public $setting;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'role_id', 'status', 'created_at', 'updated_at'], 'integer'],
			[['username', 'password', 'name', 'encrypt', 'setting'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => '用户ID',
			'username' => '用户名',
			'password' => '密码',
			'name' => '姓名',
			'encrypt' => '加密',
			'role_id' => '角色',
			'status' => '状态',
			'setting' => '设置',
			'created_at' => '添加时间',
			'updated_at' => '更新时间',
		];
	}

	public function search($params)
	{
		$query = User::find();
        $query->with([
            'role' => function($query) {
                    $query->select(['name','id']);
                }
        ]);
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
		$this->addCondition($query, 'username', true);
		$this->addCondition($query, 'password', true);
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'encrypt', true);
		$this->addCondition($query, 'role_id');
		$this->addCondition($query, 'status');
		$this->addCondition($query, 'setting', true);
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
