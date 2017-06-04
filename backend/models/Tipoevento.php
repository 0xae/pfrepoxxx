<?php

namespace backend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "tipoevento".
 *
 * @property string $idtipoevento
 * @property string $nome
 * @property string $descricao
 * @property integer $estado
 */
class Tipoevento extends \yii\db\ActiveRecord {
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tipoevento';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome'], 'required'],
            [['descricao'], 'string'],
            [['estado'], 'integer'],
            [['nome'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idtipoevento' => 'Idtipoevento',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'estado' => 'Estado',
        ];
    }

    public static function fetchActive(){
        $models = Tipoevento::find()->where(['estado' => 1])->all();
        return $models;
    }
}
