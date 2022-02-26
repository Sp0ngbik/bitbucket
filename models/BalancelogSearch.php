<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Balancelog;

/**
 * BalancelogSearch represents the model behind the search form of `app\models\Balancelog`.
 */
class BalancelogSearch extends Balancelog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','changing_value'], 'integer'],
            [['username', 'username_send', 'balance_recieve', 'balance_info', 'time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Balancelog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'username_send', $this->username_send])
            ->andFilterWhere(['like', 'balance_recieve', $this->balance_recieve])
            ->andFilterWhere(['like', 'balance_info', $this->balance_info]);

        return $dataProvider;
    }
}
