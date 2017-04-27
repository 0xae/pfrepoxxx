<?php

namespace backend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property string $idmarca
 * @property string $nome
 * @property string $logo
 * @property integer $estado
 */
class Marca extends \yii\db\ActiveRecord {
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'marca';
    }

    /*
    public function scenarios() {
        return [
            self::SCENARIO_CREATE => ['file', 'nome', 'telefone', 'sede', 'email', 'slogan'],
            self::SCENARIO_UPDATE => ['file', 'nome', 'telefone', 'sede', 'email', 'slogan'],
            'default' => ['file', 'nome'],
        ];
    }
    */

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'email'], 'required'],
            [['estado'], 'integer'],
            [['telefone'], 'string', 'max' => 45],
            [['nome', 'logo', 'sede', 'email', 'slogan'], 'string', 'max' => 255],
            /*
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['file'], 'required', 'on' => self::SCENARIO_CREATE],
            */
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idmarca' => 'Idmarca',
            'nome' => 'Nome da Marca',
            'logo' => 'Logo',
            'file' => 'Logo da Marca',
            'estado' => 'Estado',

            'telefone' => 'Telefone da Marca',
            'sede' => 'Sede da Marca',
            'slogan' => 'Slogan da Marca',
            'email' => 'Email da Marca',
        ];
    }

    public function getMarcas() {
        $models = ArrayHelper::map(Marca::find()->where(['estado' => 1])->all(),'idmarca','nome');
        return $models;
    }
}
