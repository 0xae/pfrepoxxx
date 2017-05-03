<?php
namespace backend\models;
use Yii;

class CompraBilhete extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'compra_bilhete';
    }

    public function rules() {
        return [
            [['utilizador_idutilizador', 'id_donobilhete', 'codigo_QR', 'dataCompra'], 'required'],
            [['utilizador_idutilizador', 'id_donobilhete', 'bilhete_idbilhete', 'tipo', 'pertence', 'estado'], 'integer'],
            [['business_percent'], 'decimal'],
            [['codigo_QR'], 'string'],
            [['pin'], 'string', 'max' => 10],
            [['face'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 45],
            [['qr_code'], 'string', 'max' => 255],
            [['dataCompra'], 'string', 'max' => 20]
        ];
    }

    public function attributeLabels() {
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
