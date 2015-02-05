<?php

namespace app\modules\admin\models;

/**
 * This is the model class for table "role_priv".
 *
 * @property string $role_id
 * @property string $menu_id
 *
 * @property Role $role
 * @property Menu $menu
 */
class RolePriv extends \app\modules\admin\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'admin_role_priv';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['role_id', 'menu_id'], 'required'],
			[['role_id', 'menu_id'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'role_id' => '角色ID',
			'menu_id' => '菜单ID',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getRole()
	{
		return $this->hasOne(Role::className(), ['id' => 'role_id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getMenu()
	{
		return $this->hasOne(Menu::className(), ['id' => 'menu_id'])->viaTable('admin_role_priv',['role_id'=>'id']);
	}
}
