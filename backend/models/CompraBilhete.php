<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "compra_bilhete".
 *
 * @property string $idcompra_bilhete
 * @property string $utilizador_idutilizador
 * @property integer $id_donobilhete
 * @property string $bilhete_idbilhete
 * @property string $pin
 * @property string $face
 * @property integer $tipo
 * @property string $code
 * @property string $qr_code
 * @property string $codigo_QR
 * @property integer $pertence
 * @property string $dataCompra
 * @property integer $estado
 */
class CompraBilhete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compra_bilhete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['utilizador_idutilizador', 'id_donobilhete', 'codigo_QR', 'dataCompra'], 'required'],
            [['utilizador_idutilizador', 'id_donobilhete', 'bilhete_idbilhete', 'tipo', 'pertence', 'estado'], 'integer'],
            [['codigo_QR'], 'string'],
            [['pin'], 'string', 'max' => 10],
            [['face'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 45],
            [['qr_code'], 'string', 'max' => 255],
            [['dataCompra'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcompra_bilhete' => 'Idcompra Bilhete',
            'utilizador_idutilizador' => 'Utilizador Idutilizador',
            'id_donobilhete' => 'Id Donobilhete',
            'bilhete_idbilhete' => 'Bilhete Idbilhete',
            'pin' => 'Pin',
            'face' => 'Face',
            'tipo' => 'Tipo',
            'code' => 'Code',
            'qr_code' => 'Qr Code',
            'codigo_QR' => 'Codigo  Qr',
            'pertence' => 'Pertence',
            'dataCompra' => 'Data Compra',
            'estado' => 'Estado',
        ];
    }
}
