<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;

/**
 * PersonSearch represents the model behind the search form of `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number', 'status', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'birth_day', 'birth_country', 'birth_area', 'birth_city', 'location_country', 'location_area', 'location_city', 'location_address', 'comment', 'phone', 'email'], 'safe'],
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
        $query = Person::find();

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
            'number' => $this->number,
            'birth_day' => $this->birth_day,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'birth_country', $this->birth_country])
            ->andFilterWhere(['like', 'birth_area', $this->birth_area])
            ->andFilterWhere(['like', 'birth_city', $this->birth_city])
            ->andFilterWhere(['like', 'location_country', $this->location_country])
            ->andFilterWhere(['like', 'location_area', $this->location_area])
            ->andFilterWhere(['like', 'location_city', $this->location_city])
            ->andFilterWhere(['like', 'location_address', $this->location_address])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
