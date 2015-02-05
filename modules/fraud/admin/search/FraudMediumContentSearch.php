<?php

namespace app\modules\fraud\admin\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\fraud\models\FraudMediumContent;

/**
 * FraudMediumContentSearch represents the model behind the search form about `app\modules\fraud\models\FraudMediumContent`.
 */
class FraudMediumContentSearch extends FraudMediumContent
{
    public function rules()
    {
        return [
            [['id', 'fraud_medium', 'fraud_info_id'], 'integer'],
            [['medium_content'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = $this->find()->orderBy('id DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fraud_medium' => $this->fraud_medium,
            'fraud_info_id' => $this->fraud_info_id,
        ]);

        $query->andFilterWhere(['like', 'medium_content', $this->medium_content]);

        return $dataProvider;
    }
}
