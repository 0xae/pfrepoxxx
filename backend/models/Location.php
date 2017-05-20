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
class Location extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'bussiness_id'], 'required'],
            [['bussiness_id'], 'integer'],
            [['nome', 'data_log'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idlocation' => 'Idlocation',
            'nome' => 'Nome',
            'bussiness_id' => 'Bussiness ID',
            'data_log' => 'Data Log',
        ];
    }

    /**
     * XXX: what a uggly code (ayrton)
     */
    public function getLocation() {
        $user = Yii::$app->user;
        $models = Location::find()
            ->join('INNER JOIN','business','bussiness_id=business.id')
            ->join('INNER JOIN','marca','business.id=marca.business_id')
            ->join('INNER JOIN','produtor','marca.idmarca=produtor.marca_idmarca');

        if ($user->can('producer')) {
            $models = $models->where(['idprodutor'=>$user->identity->id]);
        } else if ($user->can('business')) {
            $bizId = Yii::$app->session->get('business');
            $models = $models->where(['business.id'=>$bizId]);
        }

        $models = $models->orderBy(['nome' => SORT_ASC])->all();
        $data = ArrayHelper::map($models, 'nome', 'nome');
        return $data;
    }
}
