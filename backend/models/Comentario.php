<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property string $idcomentario
 * @property string $utilizador_idutilizador
 * @property integer $evento_idevento
 * @property string $nomeUtilizador
 * @property string $comentario
 * @property string $data
 * @property string $hora
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['utilizador_idutilizador', 'evento_idevento'], 'integer'],
            [['evento_idevento', 'nomeUtilizador', 'comentario', 'hora'], 'required'],
            [['nomeUtilizador', 'comentario'], 'string'],
            [['data'], 'string', 'max' => 12],
            [['hora'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcomentario' => 'Idcomentario',
            'utilizador_idutilizador' => 'Utilizador Idutilizador',
            'evento_idevento' => 'Evento Idevento',
            'nomeUtilizador' => 'Nome Utilizador',
            'comentario' => 'Comentario',
            'data' => 'Data',
            'hora' => 'Hora',
        ];
    }

    public function getEventos()
    {
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
        //return $this->hasMany(Evento::className(), ['idvideo' => 'id']);
    } 

     public function getIduser()
    {
        return $this->hasOne(Utilizador::className(), ['idutilizador' => 'utilizador_idutilizador']);
        //return $this->hasMany(Evento::className(), ['idvideo' => 'id']);
    }


    public function Allcomentarios($idevento){

        // $this->hasOne($this::className(), ['evento_idevento' => $idevento]);

        return $model = Comentario::find()->where(['evento_idevento' => $idevento])->orderby('idcomentario Desc')->all();
    } 
}
