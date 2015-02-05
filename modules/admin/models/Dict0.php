<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "sys_dict".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $value
 * @property string $category_id
 * @property integer $sort_num
 */
class Dict extends \app\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_dict';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'category_id'], 'required'],
            [['parent_id', 'sort_num'], 'integer'],
            [['name', 'category_id'], 'string', 'max' => 64],
            [['value'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '数据字典编号',
            'parent_id' => '父类编号',
            'name' => '名称',
            'value' => '值',
            'category_id' => '分类编号',
            'sort_num' => '数据字典排序',
        ];
    }
}
