<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nas".
 *
 * @property integer $id
 * @property string $nasname
 * @property string $shortname
 * @property string $type
 * @property integer $ports
 * @property string $secret
 * @property string $server
 * @property string $community
 * @property string $description
 * @property string $username
 * @property string $password
 */
class Nas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nasname', 'username', 'password'], 'required'],
            [['ports'], 'integer'],
            [['nasname'], 'string', 'max' => 128],
            [['shortname', 'password'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 30],
            [['secret'], 'string', 'max' => 60],
            [['server'], 'string', 'max' => 64],
            [['community'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['username'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nasname' => 'IP',
            'shortname' => '名称',
            'type' => '类型',
            'ports' => '端口',
            'secret' => '共享密码',
            'server' => 'Server',
            'community' => 'Community',
            'description' => '说明',
            'username' => '管理账号',
            'password' => '密码',
        ];
    }
}
