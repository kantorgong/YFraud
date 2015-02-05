<?php

namespace app\modules\fraud\models;

use Yii;

/**
 * This is the model class for table "fraud_medium_content".
 *
 * @property integer $id
 * @property integer $fraud_medium
 * @property integer $fraud_info_id
 * @property string $medium_content
 */
class FraudMediumContent extends \app\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fraud_medium_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fraud_medium', 'fraud_info_id', 'medium_content'], 'required'],
            [['fraud_medium', 'fraud_info_id'], 'integer'],
            [['medium_content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '介质内容编号',
            'fraud_medium' => '介质编号',
            'fraud_info_id' => '诈骗编号',
            'medium_content' => '介质内容',
        ];
    }
	/*
	 * 返回一个案例的介质信息
	 */
	public static function getFraudMediumContentByFraudid($fraudid) {
        $rs = self::find()
            ->orderBy('id DESC')
            ->select('*')
            ->where('fraud_info_id = '.$fraudid);

        $mcs = $rs->asArray()->all();
        return $mcs;
    }

    public function getFraudinfo()
    {
        return $this->hasOne(Fraudinfo::className(), ['fraud_info_id' => 'fraud_info_id']);
    }
}
