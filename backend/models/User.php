<?php

namespace backend\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $country
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord {
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],

            ['password', 'string', 'min' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Estado',
            'created_at' => 'Data de criacao',
            'updated_at' => 'Ultima Actualizacao',
        ];
    }

    public function getCountry() {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    private function getPerm($permission) {
        $auth = Yii::$app->authManager;
        $permissionObj = $auth->getRole($permission);
        if (!$permissionObj) {
            throw new NotFoundHttpException("Invalid role ${permission}.");
        }
        return $permissionObj;
    }

    public function addPermission($permission) {
        $auth = Yii::$app->authManager;
        $permissionObj = $this->getPerm($permission);
        $auth->assign($permissionObj, $this->id);
    }

    public function removePermission($permisssion) {
        $auth = Yii::$app->authManager;
        $permissionObj = $this->getPerm($permission);
        $auth->revoke($permissionObj, $this->id);
    }

    public static function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
