<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\sysprovince;

/**
 * SysprovinceSearch represents the model behind the search form about `app\modules\admin\models\sysprovince`.
 */
class SysprovinceSearch extends sysprovince
{
    public function rules()
    {
        return [
            [['codeid', 'parentid'], 'integer'],
            [['cityName'], 'safe'],
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
            'codeid' => $this->codeid,
            'parentid' => $this->parentid,
        ]);

        $query->andFilterWhere(['like', 'cityName', $this->cityName]);
        return $dataProvider;
    }
}
