<?php

namespace app\modules\fraud\admin\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\fraud\models\Fraudinfo;

/**
 * FraudinfoSearch represents the model behind the search form about `app\modules\fraud\models\Fraudinfo`.
 */
class FraudinfoSearch extends Fraudinfo
{
    public function rules()
    {
        return [
            [['fraud_info_id', 'fraud_type_id', 'fraud_info_time', 'fraud_info_begtime', 'fraud_info_endtime', 'fraud_info_systime', 'fraud_info_province', 'fraud_info_city', 'fraud_info_area', 'fraud_info_userid', 'fraud_info_iscryptonym', 'fraud_info_status', 'fraud_info_numtype', 'fraud_info_views'], 'integer'],
            [['fraud_info_title', 'fraud_info_nickname', 'fraud_info_tags', 'fraud_info_ip', 'fraud_info_content', 'fraud_info_num', 'fraud_info_depict'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = $this->find()->orderBy('fraud_info_id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fraud_info_id' => $this->fraud_info_id,
            'fraud_type_id' => $this->fraud_type_id,
            'fraud_info_time' => $this->fraud_info_time,
            'fraud_info_begtime' => $this->fraud_info_begtime,
            'fraud_info_endtime' => $this->fraud_info_endtime,
            'fraud_info_systime' => $this->fraud_info_systime,
            'fraud_info_province' => $this->fraud_info_province,
            'fraud_info_city' => $this->fraud_info_city,
            'fraud_info_area' => $this->fraud_info_area,
            'fraud_info_userid' => $this->fraud_info_userid,
            'fraud_info_iscryptonym' => $this->fraud_info_iscryptonym,
            'fraud_info_status' => $this->fraud_info_status,
            'fraud_info_numtype' => $this->fraud_info_numtype,
            'fraud_info_views' => $this->fraud_info_views,
        ]);

        $query->andFilterWhere(['like', 'fraud_info_title', $this->fraud_info_title])
            ->andFilterWhere(['like', 'fraud_info_nickname', $this->fraud_info_nickname])
            ->andFilterWhere(['like', 'fraud_info_tags', $this->fraud_info_tags])
            ->andFilterWhere(['like', 'fraud_info_ip', $this->fraud_info_ip])
            ->andFilterWhere(['like', 'fraud_info_content', $this->fraud_info_content])
            ->andFilterWhere(['like', 'fraud_info_num', $this->fraud_info_num])
            ->andFilterWhere(['like', 'fraud_info_depict', $this->fraud_info_depict]);

        return $dataProvider;
    }
}
