<?php

namespace app\modules\f1\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\f1\models\Claim;

/**
 * ClaimSearch represents the model behind the search form of `app\modules\f1\models\Claim`.
 */
class ClaimSearch extends Claim
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'current_status', 'loss_id_cis'], 'integer'],
            [['reg_date', 'doc_type', 'doc_num_pb', 'claim_id_pb', 'claim_data', 'insert_date', 'change_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Claim::find();

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
            'reg_date' => $this->reg_date,
            'current_status' => $this->current_status,
            'insert_date' => $this->insert_date,
            'change_date' => $this->change_date,
            'loss_id_cis' => $this->loss_id_cis,
        ]);

        $query->andFilterWhere(['like', 'doc_type', $this->doc_type])
            ->andFilterWhere(['like', 'doc_num_pb', $this->doc_num_pb])
            ->andFilterWhere(['like', 'claim_id_pb', $this->claim_id_pb])
            ->andFilterWhere(['like', 'claim_data', $this->claim_data]);

        return $dataProvider;
    }
}
