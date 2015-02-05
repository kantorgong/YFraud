<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "site_config".
 *
 * @property string $scope
 * @property string $id
 * @property string $value
 * @property string $note
 */
class Siteconfig extends \app\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scope', 'id'], 'required'],
            [['value'], 'string'],
            [['scope', 'id'], 'string', 'max' => 64],
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
            'scope' => '类别',
            'id' => '编号',
            'value' => '值',
            'note' => '备注',
        ];
    }
}
