<?php

namespace app\modules\vpn\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\vpn\models\Nas;

/**
 * NasSearch represents the model behind the search form about `app\modules\vpn\models\Nas`.
 */
class NasSearch extends Nas
{
    public function rules()
    {
        return [
            [['id', 'ports'], 'integer'],
            [['nasname', 'shortname', 'type', 'secret', 'server', 'community', 'description', 'username', 'password'], 'safe'],
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
            'ports' => $this->ports,
        ]);

        $query->andFilterWhere(['like', 'nasname', $this->nasname])
            ->andFilterWhere(['like', 'shortname', $this->shortname])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'server', $this->server])
            ->andFilterWhere(['like', 'community', $this->community])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
