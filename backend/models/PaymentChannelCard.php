<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_channel_card".
 *
 * @property integer $id
 * @property integer $payment_channel_id
 * @property integer $payment_card_id
 */
class PaymentChannelCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_channel_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_channel_id', 'payment_card_id'], 'required'],
            [['payment_channel_id', 'payment_card_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_channel_id' => 'Payment Channel ID',
            'payment_card_id' => 'Payment Card ID',
        ];
    }
}
