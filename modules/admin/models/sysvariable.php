<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "sys_variable".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 * @property integer $data_type
 * @property string $note
 * @property integer $is_cache
 */
class Sysvariable extends \app\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_variable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'data_type', 'is_cache'], 'required'],
            [['value'], 'string'],
            [['data_type', 'is_cache'], 'integer'],
            [['id', 'name'], 'string', 'max' => 64],
            [['note'], 'string', 'max' => 256],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '变量名',
            'name' => '标示',
            'value' => '变量值',
            'data_type' => '数据类型',
            'note' => '描述',
            'is_cache' => '是否缓存',
        ];
    }
}
