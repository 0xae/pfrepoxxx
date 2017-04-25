<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bilhete;

/**
 * BilheteSearch represents the model behind the search form about `backend\models\Bilhete`.
 */
class BilheteSearch extends Bilhete
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idbilhete', 'evento_idevento', 'estado', 'flag'], 'integer'],
            [['preco', 'imagem'], 'safe'],
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
        $query = Bilhete::find();

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
            'idbilhete' => $this->idbilhete,
            'evento_idevento' => $this->evento_idevento,
            'estado' => $this->estado,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'preco', $this->preco])
            ->andFilterWhere(['like', 'imagem', $this->imagem]);

        return $dataProvider;
    }
}
