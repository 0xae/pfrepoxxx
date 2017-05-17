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
    public $supported_cards;

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
            [['supported_cards'], 'safe'],
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

    public function getCards() {
        $data = PaymentCard::find()
               ->where(['payment_channel_id' => $this->id])
               ->all();
        if (!$data) { $data = []; }
        return $data;
    }

    public function updateCards($cards) {
        if (!$cards ) {
            return; 
        }

        PaymentCard::deleteAll('payment_channel_id = :id', ['id' => $this->id]);
        foreach($cards as $c) {
            $card = new PaymentCard();
            $card->name = $c;
            $card->payment_channel_id=$this->id;
            $card->save();
        }
    }
}

