<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-4-3
 * Time: 上午12:57
 */

namespace app\components\db;


class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * 获取默认值
     * @return array
     */
    public function getAttributeDefaults()
    {
        $attributes = [];
        foreach ($this->getTableSchema()->columns as $name => $column) {
            if (!$column->isPrimaryKey && $column->defaultValue !== null)
                $attributes[$name] = $column->defaultValue;
        }
        return $attributes;
    }
} 