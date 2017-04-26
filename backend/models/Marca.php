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
class Marca extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marca';
    }



    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';


    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['file', 'nome'],
            self::SCENARIO_UPDATE => ['file', 'nome'],
            'default' => ['file', 'nome'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['nome', 'logo'], 'string', 'max' => 100],

            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['file'], 'required', 'on' => self::SCENARIO_CREATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmarca' => 'Idmarca',
            'nome' => 'Nome',
            'logo' => 'Logo',
            'estado' => 'Estado',
        ];
    }

    public function getMarcas()
    {

        $models = ArrayHelper::map(Marca::find()->where(['estado' => 1])->all(),'idmarca','nome');

        return $models;
    }
}
