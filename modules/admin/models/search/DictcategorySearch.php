<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Dictcategory;

/**
 * DictcategorySearch represents the model behind the search form about `app\modules\admin\models\Dictcategory`.
 */
class DictcategorySearch extends Dictcategory
{
    public function rules()
    {
        return [
            [['id', 'name', 'note'], 'safe'],
            [['is_sys'], 'integer'],
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
            'is_sys' => $this->is_sys,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
