<?php

namespace app\modules\admin\models;

/**
 * This is the model class for table "menu".
 *
 * @property string $id
 * @property string $name
 * @property string $icon
 * @property string $parentid
 * @property string $controller
 * @property string $action
 * @property string $description
 * @property integer $listorder
 * @property integer $display
 *
 * @property RolePriv $rolePriv
 * @property Role[] $roles
 */
class Menu extends \app\modules\admin\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'admin_menu';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['parentid', 'listorder', 'display'], 'integer'],
			[['controller'], 'required'],
			[['name', 'icon'], 'string', 'max' => 50],
			[['controller', 'action'], 'string', 'max' => 50],
			[['description'], 'string', 'max' => 200]
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
			'description' => '说明',
			'listorder' => '排序',
			'display' => '显示',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getRolePriv()
	{
		return $this->hasOne(RolePriv::className(), ['menu_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getRoles()
	{
		return $this->hasMany(Role::className(), ['id' => 'role_id'])->viaTable('role_priv', ['menu_id' => 'id']);
	}


    public function beforeDelete() {
        if(!parent::beforeDelete()) return false;
        if(self::find()->where(['parentid'=>$this->id])->count()) {
            return false;
        }
        return true;
    }

    /**
     * 获取下拉
     * @param type $empty
     * @param type $pid
     * @return string
     */
    public static function getSelectTree($empty = NULL, $pid = 0, $noId = 0) {
        $rs = self::find()

            ->orderBy('id DESC')
            ->select('id, name, parentid')
            ->where('display = 0');

        if ($noId != 0) {
            $rs->where('id <> ' . $noId . ' AND parentid <>' . $noId);
        }
        $menus = $rs->asArray()->all();

        $tree = \app\components\helper\Tree::getInstance();
        $array = array();
        foreach ($menus as $r) {
            $r['selected'] = ($pid != 0 && $pid == $r['id']) ? 'selected' : '';
            $array[] = $r;
        }
        // print_r($array);
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->setData($array);

        if ($empty !== NULL)
            return '<option value="0">' . $empty . '</option>' . $tree->get_tree('0', $str);
        else
            return $tree->get_tree('0', $str);
    }

}
