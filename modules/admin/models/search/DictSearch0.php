<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Dict;

/**
 * DictSearch represents the model behind the search form about `app\modules\admin\models\Dict`.
 */
class DictSearch extends Dict
{
    public function rules()
    {
        return [
            [['id', 'parent_id', 'sort_num'], 'integer'],
            [['name', 'value', 'category_id'], 'safe'],
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
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'sort_num' => $this->sort_num,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'category_id', $this->category_id]);

        return $dataProvider;
    }
}
