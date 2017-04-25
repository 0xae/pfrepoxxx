<?php

namespace backend\models;
use yii\base\Model;

/**
 * Signup form
 */
class AddProducerForm extends Model {
    public $business_id;
    public $producer_id;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['business_id', 'producer_id'], 'required'],
            [['business_id', 'producer_id'], 'integer']
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     */
    public function save() {
        if (!$this->validate()) {
            return null;
        }

        $p = new BusinessProducer();
        $p->business_id = $this->business_id;
        $p->producer_id = $this->producer_id;
        return $p->save();
    }
}
