<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\sysvariable;

/**
 * SysvariableSearch represents the model behind the search form about `app\modules\admin\models\sysvariable`.
 */
class SysvariableSearch extends sysvariable
{
    public function rules()
    {
        return [
            [['id', 'name', 'value', 'note'], 'safe'],
            [['data_type', 'is_cache'], 'integer'],
        ];
    }

    public function search($params)
    {
        $query = $this->find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'data_type' => $this->data_type,
            'is_cache' => $this->is_cache,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
