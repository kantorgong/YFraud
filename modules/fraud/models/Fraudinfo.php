<?php

namespace app\modules\fraud\models;

use Yii;

/**
 * This is the model class for table "fraud_info".
 *
 * @property integer $fraud_info_id
 * @property string $fraud_info_title
 * @property integer $fraud_type_id
 * @property string $fraud_info_time
 * @property string $fraud_info_begtime
 * @property string $fraud_info_endtime
 * @property string $fraud_info_systime
 * @property string $fraud_info_province
 * @property string $fraud_info_city
 * @property string $fraud_info_area
 * @property integer $fraud_info_userid
 * @property string $fraud_info_nickname
 * @property integer $fraud_info_iscryptonym
 * @property string $fraud_info_tags
 * @property string $fraud_info_ip
 * @property string $fraud_info_content
 * @property integer $fraud_info_status
 * @property integer $fraud_info_numtype
 * @property string $fraud_info_num
 * @property string $fraud_info_depict
 * @property integer $fraud_info_views
 */
class Fraudinfo extends \app\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fraud_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['fraud_info_title', 'fraud_type_id', 'fraud_info_time', 'fraud_info_begtime', 'fraud_info_endtime', 'fraud_info_systime', 'fraud_info_province', 'fraud_info_city', 'fraud_info_area', 'fraud_info_userid', 'fraud_info_nickname', 'fraud_info_tags', 'fraud_info_usertags','fraud_info_ip', 'fraud_info_content', 'fraud_info_status', 'fraud_info_numtype', 'fraud_info_num', 'fraud_info_depict'], 'required'],
           // [['fraud_info_title', 'fraud_type_id', 'fraud_info_time', 'fraud_info_province', 'fraud_info_city', 'fraud_info_area',  'fraud_info_content'], 'required'],
           // [['fraud_type_id'], 'integer'],

//            [['fraud_info_content',], 'string'],
//            [['fraud_info_title'], 'string', 'min' => 20, 'max' => '60'],
//            [['fraud_info_province', 'fraud_info_city', 'fraud_info_area', 'fraud_info_address'], 'string', 'max' => 250],

            [['fraud_info_title', 'fraud_info_province', 'fraud_info_city', 'fraud_info_area', 'fraud_info_iscryptonym'], 'required'],
            [['fraud_info_time'], 'safe'],
            [['fraud_info_content', 'fraud_info_depict'], 'string'],
            [['fraud_info_title'], 'string', 'max' => 200],
            [['fraud_info_province', 'fraud_info_city', 'fraud_info_area', 'fraud_info_address'], 'string', 'max' => 250],
            [['fraud_info_nickname'], 'string', 'max' => 50],
            [['fraud_info_tags','fraud_info_usertags','fraud_info_doc'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fraud_info_id' => '诈骗编号',
            'fraud_info_title' => '诈骗标题',
            'fraud_type_id' => '诈骗分类编号',
            'fraud_info_time' => '诈骗时间',
            'fraud_info_begtime' => '诈骗开始时间',
            'fraud_info_endtime' => '诈骗结束时间',
            'fraud_info_systime' => '诈骗提交时间',
            'fraud_info_province' => '诈骗省份',
            'fraud_info_city' => '诈骗城市',
            'fraud_info_area' => '诈骗县区',
            'fraud_info_address' => '诈骗街道',
            'fraud_info_userid' => '诈骗信息发布人编号',
            'fraud_info_nickname' => '诈骗信息发布人昵称',
            'fraud_info_iscryptonym' => '是否匿名 0为不匿名',
            'fraud_info_tags' => '用户标签',
			'fraud_info_usertags' => '用户自定义标签',
            'fraud_info_ip' => '诈骗信息发布ip',
            'fraud_info_content' => '诈骗信息发布内容',
            'fraud_info_status' => '诈骗信息状态 0正常 1删除',
            'fraud_info_numtype' => '诈骗信息介质类型',
            'fraud_info_num' => '诈骗信息介质内容',
            'fraud_info_depict' => '诈骗信息描述',
            'fraud_info_doc' => '诈骗信息文件',
            'fraud_info_views' => '诈骗信息查看次数',
        ];
    }
//    public function getMediumContent($medium_content)
//    {
//        return self::hasMany(FraudMediumContent::className(), ['fraud_info_id' => 'fraud_info_id'])
//            ->where('medium_content ='.$medium_content)
//            ->orderBy('fraud_info_id');
//    }

    public function getMediumContent($medium_content)
    {
        return $this->hasMany(FraudMediumContent::className(), ['fraud_info_id' => 'fraud_info_id'])
            ->where('medium_content = ":medium_content"', [':medium_content' => $medium_content])
            ->orderBy('fraud_info_id');
    }
}
