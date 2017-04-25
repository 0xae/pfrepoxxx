<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "business_producer".
 *
 * @property integer $id
 * @property integer $business_id
 * @property integer $producer_id
 *
 * @property Business $business
 */
class BusinessProducer extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'business_producer';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['business_id', 'producer_id'], 'required'],
            [['business_id', 'producer_id'], 'integer'],
            [['business_id'], 'exist', 'skipOnError' => true, 'targetClass' => Business::className(), 'targetAttribute' => ['business_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'business_id' => 'Business ID',
            'producer_id' => 'Producer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusiness() {
        return $this->hasOne(Business::className(), ['id' => 'business_id']);
    }
}
