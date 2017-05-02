<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "utilizador".
 *
 * @property string $idutilizador
 * @property string $nome
 * @property string $apelido
 * @property string $data_nascimento
 * @property string $foto
 * @property string $password
 * @property string $email
 * @property string $registration_id
 * @property string $token
 * @property string $tipoCadastro
 * @property string $sexo
 * @property string $last_login
 * @property string $timelogin
 */
class Utilizador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_nascimento', 'last_login'], 'safe'],
            [['foto', 'password', 'registration_id', 'last_login', 'timelogin'], 'required'],
            [['nome', 'apelido', 'email'], 'string', 'max' => 100],
            [['foto', 'password', 'registration_id', 'tipoCadastro'], 'string', 'max' => 255],
            [['token', 'sexo'], 'string', 'max' => 45],
            [['timelogin'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idutilizador' => 'Idutilizador',
            'nome' => 'Nome',
            'apelido' => 'Apelido',
            'data_nascimento' => 'Data Nascimento',
            'foto' => 'Foto',
            'password' => 'Password',
            'email' => 'Email',
            'registration_id' => 'Registration ID',
            'token' => 'Token',
            'tipoCadastro' => 'Tipo Cadastro',
            'sexo' => 'Sexo',
            'last_login' => 'Last Login',
            'timelogin' => 'Timelogin',
        ];
    }
}
