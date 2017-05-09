<?php

namespace backend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $idlocation
 * @property string $nome
 * @property integer $bussiness_id
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'bussiness_id'], 'required'],
            [['bussiness_id'], 'integer'],
            [['nome', 'data_log'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlocation' => 'Idlocation',
            'nome' => 'Nome',
            'bussiness_id' => 'Bussiness ID',
            'data_log' => 'Data Log',
        ];
    }

    public function getLocation(){

        $models = ArrayHelper::map(Location::find()
        ->join('INNER JOIN','business','bussiness_id=business.id')
        ->join('INNER JOIN','marca','business.id=marca.business_id')
        ->join('INNER JOIN','produtor','marca.idmarca=produtor.marca_idmarca')
        ->where(['idprodutor'=>Yii::$app->user->identity->id])
        ->groupBy('nome')
        ->orderBy(['nome' => SORT_ASC])
        ->all(),'nome','nome');

        /*$models = (new \yii\db\Query())
        ->select(['l.idlocation', 'l.nome', 'b.id', 'p.idprodutor'])
        ->from('location l')
        ->join('join','business b','l.bussiness_id=b.id')
        ->join('join','marca m','b.id=m.business_id')
        ->join('join','produtor p','m.idmarca=p.marca_idmarca')
        ->where(['p.idprodutor'=>Yii::$app->user->identity->id])
        ->groupBy('nome')
        ->orderBy(['idlocation' => SORT_ASC])
        ->all();*/

        return $models;
    }
}
