<?php
namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;


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

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'business_id', 'email'], 'required'],
            [['estado', 'business_id'], 'integer'],
            [['email'], 'email'],
            [['telefone'], 'string', 'max' => 45],
            [['nome', 'logo', 'sede', 'email', 'slogan'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'checkExtensionByMimeType'=>true, 'maxFiles' => 1],
            ['email', 'unique',  'message' => 'This email address has already been taken.'],
            [['file'], 'required', 'on' => self::SCENARIO_CREATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idmarca' => 'Idmarca',
            'nome' => 'Nome ',
            'logo' => 'Logo',
            'file' => 'Logo ',
            'estado' => 'Estado',

            'telefone' => 'Telefone ',
            'sede' => 'Sede ',
            'slogan' => 'Slogan ',
            'email' => 'Email ',
        ];
    }

    /**
     * TODO: rename this to getResponsable() 
    */
    public function getProdutor() {
        return Produtor::find()
               ->where(['marca_idmarca' => $this->idmarca])
               ->one();
    }

    /**
     * TODO: work on this
     * XXX: maybe enhance it a little more
     * XXX: make sure the subquery never returns more than one result after removing 'limit 1'
    */
    public function getNextEvents($start, $end) {
        $query = Evento::find()
                 ->where('data >= :start and data <= :end')
                 ->andWhere('produtor_idprodutor = (select idprodutor from produtor where marca_idmarca = :mid limit 1)')
                 ->addParams([':mid'=>$this->idmarca, 'start'=>$start, 'end'=>$end])
                 ->orderBy('data ASC');
        return $query->all();
    }

    public static function findModel($id) {
        if (($model = Marca::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

