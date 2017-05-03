<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bilhete".
 *
 * @property string $idbilhete
 * @property string $evento_idevento
 * @property string $preco
 * @property string $imagem
 * @property integer $estado
 * @property integer $flag
 */
class Bilhete extends \yii\db\ActiveRecord {
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $file;

    public static function tableName() {
        return 'bilhete';
    }

    public function scenarios() {
        return [
            self::SCENARIO_CREATE => ['file', 'preco', 'evento_idevento', 'nome_bilhete', 'stock', 'descricao_bilhete'],
            self::SCENARIO_UPDATE => ['file', 'preco', 'evento_idevento', 'nome_bilhete', 'stock', 'descricao_bilhete'],
            'default' => ['file', 'preco', 'evento_idevento', 'nome_bilhete', 'stock', 'descricao_bilhete', 'idbilhete'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['preco', 'evento_idevento', 'nome_bilhete', 'stock'], 'required'],
            [['evento_idevento', 'estado', 'flag', 'idbilhete','preco','stock'], 'integer'],
            [['business_percent'], 'decimal'],
            [['nome_bilhete'], 'string', 'max' => 45],
            [['imagem'], 'string', 'max' => 100],
            [['descricao_bilhete'], 'string'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['file'], 'required', 'on' => self::SCENARIO_CREATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idbilhete' => 'Idbilhete',
            'evento_idevento' => 'Evento Idevento',
            'preco' => 'Preco',
            'imagem' => 'Imagem',
            'estado' => 'Estado',
            'Stock' => 'Stock',
            'flag' => 'Flag',
        ];
    }
}
