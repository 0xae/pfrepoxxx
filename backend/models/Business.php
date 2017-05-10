<?php
namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\Query;

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

    public function save($runValidation=true, $attributeNames=NULL) {
        $isNew = !$this->id;
        $t = parent::save($runValidation, $attributeNames);
        if ($t && $isNew) {
            $c = Country::find()->where(['id' => $this->country_id])->one();
            $c->business_id = $model->id;
            $c->save();
        }
        return $t;
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
        return $this->hasOne(Country::className(), ['id' => 'country_id'])->one();
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

    public function getRange() {
        $biz = $this;
        $today = date('Y-m-d');
        if ($biz->cashout == 'mensal') {
            return [
                date('Y-m-01'), date("Y-m-t", strtotime($today))
            ];
        } else if ($biz->cashout == 'trimestral') {
            $s1 = [date('Y-01-01'), date('Y-03-31')];
            $s2 = [date('Y-04-01'), date('Y-06-31')];
            $s3 = [date('Y-07-01'), date('Y-09-31')];
            $s4 = [date('Y-10-01'), date('Y-12-31')];

            if ($this->inRange($s1[0], $s1[1], $today)) {
                return $s1;
            } else if ($this->inRange($s2[0], $s2[1], $today)) {
                return $s2;
            } else if ($this->inRange($s3[0], $s3[1], $today)) {
                return $s3;
            } else if ($this->inRange($s4[0], $s4[1], $today)) {
                return $s4;
            }

        } else if ($biz->cashout == 'semestral') {
            $s1 = [date('Y-01-01'), date('Y-06-31')];
            $s2 = [date('Y-07-01'), date('Y-12-31')];

            if ($this->inRange($s1[0], $s1[1], $today)) {
                return $s1;
            } else {
                return $s2;
            }
        } else if ($biz->cashout == 'anual') {
            return [
                date('Y-01-01'), date('Y-12-31')
            ];
        }
    }

    private function inRange($start_date, $end_date, $date_from_user) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    /**
     * TODO: maybe rewrite this using yii's ActiveQuery api
     * i feel like this code is too much long
    */
    public static function getResponsableSugestions() {
        $sql = "(
            SELECT 
                U.ID as id,
                U.EMAIL as email,
                COALESCE(F.NAME, U.USERNAME) AS username
            FROM USER U
            LEFT JOIN BUSINESS B ON B.RESPONSABLE=U.ID
            JOIN AUTH_ASSIGNMENT P ON P.ITEM_NAME='business' AND P.USER_ID=U.ID
            LEFT JOIN PROFILE F ON F.user_id = U.id
            WHERE B.ID IS NULL
        )";

        $ret = [];
        $data = (new Query())
                ->select(['*'])
                ->from(['f'=>$sql])
                ->all();

        foreach ($data as $k) {
            $key = $k['id'];
            $value= $k['username'];
            $ret[$key] = $value;
        }

        return $ret;
    }

    public function getProducers() {
        return Marca::find()->where(['business_id' => $this->id])->all();
    }

    public static function getProducersFromSession() {
        $session = \Yii::$app->session;
        $id = $session->get('business');
        return Marca::find()
                ->where(['business_id' => $id])
                ->all();
    }

    public static function findModel($id) {
        if (($model = Business::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function behaviors() {  
        return [  
            BlameableBehavior::className(),  
            TimestampBehavior::className()  
        ];  
    } 
}

