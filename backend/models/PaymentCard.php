<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_channel_card".
 *
 * @property integer $id
 * @property string $name
 * @property integer $payment_channel_id
 */
class PaymentCard extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'payment_channel_card';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'payment_channel_id'], 'required'],
            [['payment_channel_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'payment_channel_id' => 'Payment Channel ID',
        ];
    }
}
