<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $logo
 * @property integer $created_at
 * @property integer $updated_at
 */
class Country extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'code'], 'required'],
            [['logo'], 'string'],
            [['is_active'], 'boolean'],
            [['created_at', 'business_id', 'updated_at'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID #',
            'name' => 'Name',
            'code' => 'Code',
            'logo' => 'Logo',
            'created_at' => 'Data de criacao',
            'updated_at' => 'Data de modificacao',
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className()
        ];
    }

    public function getBusinessLabel() {
        $biz = $this->hasOne(Business::className(), ['id' => 'business_id'])->one();
        if ($biz) {
            return $biz->name;
        }

        return null;
    }

    public static function findModel($countryId) {
        if (($model = Country::findOne($countryId)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function fetchActive() {
        $data = Country::find()->where(['is_active' => true])->all();
        return $data;
    }
}

