<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "business".
 *
 * @property integer $id
 * @property string $name
 * @property string $payment_channel
 * @property string $cashout
 * @property string $privacy
 * @property string $responsable_percent
 * @property integer $responsable
 * @property string $support_name
 * @property string $support_email
 * @property string $support_phone
 * @property string $picture
 * @property integer $country_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Country $country
 * @property User $createdBy
 * @property User $responsable0
 * @property User $updatedBy
 */
class Business extends \yii\db\ActiveRecord {
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'business';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'payment_channel', 'cashout', 'privacy', 'responsable_percent', 'responsable', 'support_name', 'support_email', 'support_phone', 'country_id'], 'required'],
            [['responsable_percent'], 'number'],
            [['responsable',  'country_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['picture'], 'string'],
            [['name',  'payment_channel','cashout', 'privacy', 'support_name', 'support_email', 'support_phone'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['responsable'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['responsable' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'checkExtensionByMimeType'=>true, 'maxFiles' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'payment_channel' => 'Payment Channel',
            'cashout' => 'Cashout',
            'privacy' => 'Privacy',
            'responsable_percent' => 'Responsable Percent',
            'responsable' => 'Responsable',
            'support_name' => 'Support Name',
            'support_email' => 'Support Email',
            'support_phone' => 'Support Phone',
            'picture' => 'Picture',
            'country_id' => 'Country ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry() {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable() {
        return $this->hasOne(User::className(), ['id' => 'responsable']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getCountryLabel() {
        $c = $this->getCountry()->one();
        if ($c) { return $c->name; }
        return '';
    }

    public function behaviors() {  
        return [  
            BlameableBehavior::className(),  
            TimestampBehavior::className()  
        ];  
    } 
}
