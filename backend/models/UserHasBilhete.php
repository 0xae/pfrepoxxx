<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_has_bilhete".
 *
 * @property string $id
 * @property string $evento_idevento
 * @property string $idcompra_bilhete
 * @property string $hora
 */
class UserHasBilhete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_has_bilhete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evento_idevento', 'idcompra_bilhete', 'hora'], 'required'],
            [['evento_idevento', 'idcompra_bilhete'], 'integer'],
            [['hora'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'evento_idevento' => 'Evento Idevento',
            'idcompra_bilhete' => 'Idcompra Bilhete',
            'hora' => 'Hora',
        ];
    }
}
