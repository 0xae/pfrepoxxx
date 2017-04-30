<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "evento".
 *
 * @author janito (possibly)
 * @author ayrton
 * @notes class constants (const) always come before instance members
 * @property string $idevento
 * @property string $produtor_idprodutor
 * @property string $nome
 * @property string $data
 * @property string $hora
 * @property string $local
 * @property string $descricao
 * @property string $cartaz
 * @property integer $estado
 */

class Evento extends \yii\db\ActiveRecord {
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    //Ilhas
    const SANTO_ANTAO = 'Santo Antão';
    const SAO_VICENTE = 'São Vicente';
    const SAO_NICOLAU = 'São Nicolau';
    const SAL = 'Sal';
    const BOAVISTA = 'Boavista';
    const MAIO = 'Maio';
    const SANTIAGO = 'Santiago';
    const FOGO = 'Fogo';
    const BRAVA = 'Brava';

    //filtro
    const FILTRO1 = '#fe933c';
    const FILTRO2 = '#00b55a';
    const FILTRO3 = '#00afea';
    const FILTRO4 = '#ce182a';
    const FILTRO5 = '#784c2e';

    public $file;
    public $marca;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'evento';
    }

    public function scenarios() {
        return [
            self::SCENARIO_CREATE => [
                'file', 'tipoevento_idtipoevento', 'ilha',    
                'filtro', 'nome', 'data', 'hora', 'local',
                'cartaz', 'descricao'
            ],
            self::SCENARIO_UPDATE => [
                'file', 'tipoevento_idtipoevento', 'ilha', 
                'filtro', 'nome', 'data', 'hora', 'local', 
                'cartaz', 'descricao'
            ],
            'default' => [
                'file', 'tipoevento_idtipoevento', 'ilha', 
                'filtro', 'nome', 'data', 'hora', 'local',
                'cartaz', 'descricao'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'data', 'hora', 'local', 'cartaz', 'tipoevento_idtipoevento', 'ilha', 'filtro'], 'required'],
            [['produtor_idprodutor', 'tipoevento_idtipoevento', 'estado'], 'integer'],
            [['data', 'hora'], 'safe'],
            [['descricao'], 'string'],
            [['nome', 'local', 'cartaz'], 'string', 'max' => 100],
            [['ilha', 'filtro'], 'string', 'max' => 45],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            
            //[['file'],"file","extensions"=>"png, gif, jpg"],
            //['data', 'checkDate'],
        ];
    }


    public function checkDate($attribute, $param) {
        date_default_timezone_set('Atlantic/Cape_Verde');
        $today = date('Y-m-d', time());
        $select = $this->data;
        if ($select < $today) {
            $this->addError($attribute, 'error');
        }
    }
   
    public function attributeLabels() {
        return [
            'idevento' => 'Idevento',
            'produtor_idprodutor' => 'Produtor Idprodutor',
            'nome' => 'Nome',
            'data' => 'Data',
            'hora' => 'Hora',
            'local' => 'Local',
            'descricao' => 'Descricao',
            'cartaz' => 'Cartaz',
            'estado' => 'Estado',
            'tipoevento_idtipoevento'=>'Tipo de Evento',
            'file'=>'Imagem'
        ];
    }

    public function getIlhas() {
        return [
            self::SANTO_ANTAO => self::SANTO_ANTAO,
            self::SAO_VICENTE => self::SAO_VICENTE,
            self::SAO_NICOLAU => self::SAO_NICOLAU,
            self::SAL => self::SAL,
            self::BOAVISTA => self::BOAVISTA,
            self::MAIO => self::MAIO,
            self::SANTIAGO => self::SANTIAGO,
            self::FOGO => self::FOGO,
            self::BRAVA => self::BRAVA
        ];
    }

    public function getFiltros() {
        return [
            self::FILTRO1 => self::FILTRO1,
            self::FILTRO2 => self::FILTRO2,
            self::FILTRO3 => self::FILTRO3,
            self::FILTRO4 => self::FILTRO4,
            self::FILTRO5 => self::FILTRO5
        ];
    }

    public function getEventos(){
        $models = ArrayHelper::map(Evento::find()->where(['estado' => 1])->all(),'idevento','nome');
        return $models;
    }

    public function getAllEventos(){
        $models = Evento::find()->where(['estado' => 1])->orderBy('data DESC')->limit(7)->all();
        return $models;
    }
}

