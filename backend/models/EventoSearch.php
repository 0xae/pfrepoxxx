<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Evento;

/**
 * EventoSearch represents the model behind the search form about `backend\models\Evento`.
 */
class EventoSearch extends Evento {
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['idevento', 'produtor_idprodutor', 'estado'], 'integer'],
            [['nome', 'data', 'hora', 'local', 'descricao', 'cartaz'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Evento::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idevento' => $this->idevento,
            'produtor_idprodutor' => $this->produtor_idprodutor,
            'data' => $this->data,
            'hora' => $this->hora,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'cartaz', $this->cartaz]);

        return $dataProvider;
    }
}
