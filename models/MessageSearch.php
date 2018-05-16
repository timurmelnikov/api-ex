<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message;

/**
 * MessageSearch represents the model behind the search form of `app\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'message_type_id', 'message_status_id'], 'integer'],
            [['message_status_text', 'subject', 'body', 'send_to', 'insert_date', 'send_after', 'send_date'], 'safe'],
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
        $query = Message::find();

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
            'message_type_id' => $this->message_type_id,
            'message_status_id' => $this->message_status_id,
            'insert_date' => $this->insert_date,
            'send_after' => $this->send_after,
            'send_date' => $this->send_date,
        ]);

        $query->andFilterWhere(['like', 'message_status_text', $this->message_status_text])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'send_to', $this->send_to]);

        return $dataProvider;
    }
}
