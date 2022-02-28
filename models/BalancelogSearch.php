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
            [['id', 'changing_value'], 'integer'],
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
    public function searchUserSend($username)
    {
        $query = Balancelog::find()->where(['username' => $username,]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($username);

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
    public function searchUserRecieve($user_recieve)
    {
        $query = Balancelog::find()->where(['username_send' => $user_recieve,]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($user_recieve);

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



// Disable the built-in VSCode PHP Language Features.

// Go to Extensions.
// Search for @builtin php
// Disable PHP Language Features. Leave PHP Language Basics enabled for syntax highlighting.
// Note that other (3rd party) PHP extensions which provide similar functionality should also be disabled for best results.

// Add glob patterns for non standard php file extensions to the files.associations setting.

// For example: "files.associations": { "*.module": "php" }.

// Optionally purchase and enter your licence key by opening the command pallete

// -- ctrl + shift + p -- and searching for Enter licence key.

// Further configuration options are available in the intelephense section of settings.