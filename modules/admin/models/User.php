<?php

namespace app\modules\admin\models;

use app\components\helper\Regexp;
use app\components\helper\StringHelper;
use app\modules\admin\Module;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $encrypt
 * @property string $role_id
 * @property integer $status
 * @property string $setting
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Role $role
 */
class User extends \app\modules\admin\components\ActiveRecord implements IdentityInterface
{

    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
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
            [['username,name'], 'filter', 'filter' => 'trim'],
            [['username', 'name', 'encrypt', 'role_id'], 'required'],
            [['role_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['setting'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 20, 'min' => 2],
            [['password'], 'string', 'max' => 40, 'min' => 6],
            [['encrypt'], 'string', 'max' => 6],
            [['username'], 'unique'],
            [['username'], 'match', 'pattern' => Regexp::$username, 'message' => '用户名格式不正确！'],

            ['password', 'required', 'on' => 'default']
        ];
    }

    public function scenarios()
    {
        return [
            'default' => ['username', 'password', 'name', 'encrypt', 'role_id', 'status', 'setting'],
            'update' => ['username', 'password', 'name', 'encrypt', 'role_id', 'status', 'setting'],
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
            'status' => '禁用',
            'setting' => '设置',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
        ];
    }

    /***************  数据关系 ***************/
    /**
     * @return \yii\db\ActiveRelation
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord)
            $this->encrypt = StringHelper::random(6);
        return parent::beforeValidate();
    }

    /**
     * 保存前
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) return false;
        if ($this->isNewRecord)
            $this->password = self::hashPassword($this->password, $this->encrypt);
        else {
            if ($this->getScenario() === 'update') {
                if (!empty($this->password)) {
                    $this->encrypt = StringHelper::random(6);
                    $this->password = self::hashPassword($this->password, $this->encrypt);
                } else {
                    $this->password = $this->oldAttributes['password'];
                }
            }

        }

        return true;
    }

    /**
     *
     * @param string $password 明文密码
     * @return string 加密后
     */
    public static function hashPassword($password, $encrypt)
    {
        return md5(md5($password) . $encrypt);
    }

    /*************** 用户登陆 **********************/
    /**
     * 获取用户ID
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * 获取用户
     * @param int|string $id
     * @return User
     */
    public static function findIdentity($id)
    {
        $model = self::findOne($id);


        return $model;
    }

    public static function findIdentityByAccessToken($token,$type = NULL)
    {
        $id = Security::decrypt($token, AUTH_KEY);

        return static::findOne(['id' => $id, 'status' => [
            static::STATUS_ACTIVE
        ]]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return self
     */
    public static function findByUsername($username)
    {
        $file = 'username';



        return static::findOne([$file => $username, 'status' => [
            static::STATUS_ACTIVE
        ]]);
    }

    /**
     * 获取
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return Security::encrypt($this->id, AUTH_KEY);
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 验证密码
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password == self::hashPassword($password, $this->encrypt);
    }

}
