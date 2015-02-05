<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "sys_province".
 *
 * @property integer $codeid
 * @property integer $parentid
 * @property string $cityName
 */
class Sysprovince extends \app\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'cityName'], 'required'],
            [['parentid'], 'integer'],
            [['cityName'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codeid' => '编号',
            'parentid' => '父级编号',
            'cityName' => '名称',
        ];
    }
}
