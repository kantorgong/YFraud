<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Siteconfig;

/**
 * SiteConfigSearch represents the model behind the search form about `app\modules\admin\models\Siteconfig`.
 */
class SiteConfigSearch extends Siteconfig
{
    public function rules()
    {
        return [
            [['scope', 'id', 'value', 'note'], 'safe'],
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

        $query->andFilterWhere(['like', 'scope', $this->scope])
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
