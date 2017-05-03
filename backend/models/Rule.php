<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "regras".
 *
 * @property integer $id
 * @property integer $percentagem_bilhete
 * @property double $preco_min
 * @property double $preco_max
 * @property string $nome_regra
 * @property integer $stockMin
 * @property integer $stockMax
 */
class Rule extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'regras';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['percentagem_bilhete', 'preco_min', 'preco_max', 'nome_regra', 'stockMin', 'stockMax'], 'required'],
            [['percentagem_bilhete', 'stockMin', 'stockMax'], 'integer'],
            [['preco_min', 'preco_max'], 'number'],
            [['nome_regra'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'percentagem_bilhete' => 'Percentagem Bilhete',
            'preco_min' => 'Preco Min',
            'preco_max' => 'Preco Max',
            'nome_regra' => 'Nome Regra',
            'stockMin' => 'Stock Min',
            'stockMax' => 'Stock Max',
        ];
    }
}
