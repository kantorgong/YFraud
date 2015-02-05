<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "sys_dict_category".
 *
 * @property string $id
 * @property string $name
 * @property string $note
 * @property integer $is_sys
 */
class DictCategory extends \app\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_dict_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'is_sys'], 'required'],
            [['is_sys'], 'integer'],
            [['id', 'name'], 'string', 'max' => 64],
            [['note'], 'string', 'max' => 512],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '缓存Key',
            'name' => '数据字典分类名称',
            'note' => '数据字典分类标注',
            'is_sys' => '是否系统',
        ];
    }
}
