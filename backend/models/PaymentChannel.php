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
            [['is_active'], 'integer'],
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
            'is_active' => 'Is Active',
        ];
    }

    public function getCards() {
        $data = (new \yii\db\Query())
                ->select(['card.id', 'card.name', 'card.logo'])
                ->from('payment_channel_card cc')
                ->join('JOIN', 'payment_channel channel', 'channel.id = cc.payment_channel_id')
                ->join('JOIN', 'payment_card card', 'card.id = cc.payment_card_id')
                ->where(['channel.id'=>$this->id])
                ->all();
        if (!$data) {
            $data = []; 
        }
        return $data;
    }

    public function updateCards($cards) {
        PaymentChannelCard::deleteAll('payment_channel_id = :id', ['id' => $this->id]);
        if (!$cards) { return; }
        foreach($cards as $k=>$v) {
            $card = new PaymentChannelCard();
            $card->payment_channel_id=$this->id;
            $card->payment_card_id = (int) $v;
            $card->save();
        }
    }

    public static function fetchActive() {
        $data = PaymentChannel::find()->where(['is_active' => true])->all();
        return $data;
    }
}

