<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "utilizador_app_mensagem".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $idBusiness
 * @property string $mensagem
 * @property string $data
 * @property integer $is_read
 */
class UtilizadorAppMensagem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'utilizador_app_mensagem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'idBusiness', 'mensagem'], 'required'],
            [['id', 'id_user', 'idBusiness', 'is_read'], 'integer'],
            [['mensagem'], 'string'],
            [['data'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'idBusiness' => 'Id Business',
            'mensagem' => 'Mensagem',
            'data' => 'Data',
            'is_read' => 'Is Read',
        ];
    }
}
