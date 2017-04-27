<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "produtor".
 *
 * @property string $idprodutor
 * @property string $marca_idmarca
 * @property string $nome
 * @property string $apelido
 * @property string $public_email
 * @property string $sexo
 * @property string $telefone
 * @property string $foto
 * @property integer $estado
 */
class Produtor extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'produtor';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['marca_idmarca', 'apelido', 'public_email', 'nome', 'telefone'], 'required'],
            [['marca_idmarca', 'user_id', 'estado'], 'integer'],
            [['public_email'], 'email'],
            [['nome', 'apelido', 'foto'], 'string', 'max' => 100],
            [['public_email', 'sexo', 'telefone'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idprodutor' => 'Idprodutor',
            'marca_idmarca' => 'Marca Idmarca',
            'nome' => 'Nome',
            'apelido' => 'Apelido',
            'public_email' => 'Public Email',
            'sexo' => 'Sexo',
            'telefone' => 'Telefone',
            'foto' => 'foto',
            'estado' => 'Estado',
        ];
    }

    public function getUsersProdutors($id) {
        $model = Produtor::find()->where(['estado' => 1])->all();
        return $model;
    }
}
