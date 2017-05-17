<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_channel".
 *
 * @property integer $id
 * @property string $name
 * @property string $link
 */
class PaymentChannel extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'payment_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['link'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'link' => 'Link',
        ];
    }
}

