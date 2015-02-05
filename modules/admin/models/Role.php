<?php

namespace app\modules\admin\models;


use app\modules\admin\Module;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property integer $disabled
 * @property string $created_at
 * @property string $updated_at
 *
 * @property RolePriv $rolePriv
 * @property Menu[] $menus
 * @property User[] $users
 */
class Role extends \app\modules\admin\components\ActiveRecord
{
    const MENU_CACHE_PREFIX = 'role_menu_';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'admin_role';
	}

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name'], 'required'],
			[['description'], 'string'],
			[['disabled', 'created_at', 'updated_at'], 'integer'],
			[['name'], 'string', 'max' => 50],
			[['name'], 'unique']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => '角色名',
			'description' => '说明',
			'disabled' => '启用',
			'created_at' => '添加时间',
			'updated_at' => '更新时间',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getRolePriv()
	{
		return $this->hasOne(RolePriv::className(), ['role_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getMenus()
	{
		return $this->hasMany(Menu::className(), ['id' => 'menu_id'])->viaTable('admin_role_priv', ['role_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getUsers()
	{
		return $this->hasMany(User::className(), ['role_id' => 'id']);
	}

    /**
     * 删除后
     */
    public function afterDelete() {
        parent::afterDelete();
        $this->delCache();
    }
    /**
     * 保存后
     */
    public function afterSave($insert, $options = Array())
    {
        parent::afterSave($insert);
        $this->delCache();
    }

    /**
     * 删除缓存
     */
    public function delCache() {
        Module::getCache()->delete(self::MENU_CACHE_PREFIX.$this->id);
        Module::getCache()->delete(self::MENU_CACHE_PREFIX.$this->id.'_controllers');
    }

    /**
     * 获取用户下拉框选项
     *
     * @param string $index
     * @param string $lable
     * @return array
     */
    public static function listDate($index="id", $lable="name") {
        $rs = self::find()->select([$index,$lable])->all();
        $listData = [];
        foreach($rs as $r) {
            $listData[$r->id] = $r->$lable;
        }
        return $listData;
    }

    public function getMenu() {
        $cacheId = self::MENU_CACHE_PREFIX.$this->id;
        $menus = Module::getCache()->get($cacheId);
        if($menus)
            return $menus;
        $menus = $this->getMenus()->indexBy('id')->orderBy('listorder DESC')->asArray()->all();
        Module::getCache()->set($cacheId,$menus);
        return $menus;
    }

    public function getControllers() {
        $cacheId = self::MENU_CACHE_PREFIX.$this->id.'_controllers';
        $arr = Module::getCache()->get($cacheId);
        if($arr)
            return $arr;
        foreach($this->getMenu() as $id=>$menu) {
            if($menu['controller'] == '#')
                continue;
            $arr[$id] = $menu['controller'].'/'.$menu['action'];
        }
        Module::getCache()->set($cacheId,$arr);
        return $arr;

    }


}
