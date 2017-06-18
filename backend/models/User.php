<?php
namespace backend\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 */
class User extends \yii\db\ActiveRecord {
    public $nome;
    public $password;
    public $permissions;

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
            [['status', 'country_id', 'tipo_user', 'created_at', 'updated_at'], 'integer'],
            [['nome', 'username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['password', 'string', 'min' => 6],
            [['tipo_user'], 'safe']
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
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

    public function revokeAll() {
        RoleAssignment::deleteAll('user_id = :id', ['id' => $this->id]);
    }

    /**
     * XXX: should we delete all existing permissions ?
     */
    public static function updatePermissionsOf($userId, $ary) {
        RoleAssignment::deleteAll('user_id = :id', ['id' => $userId]);
        self::updateType($userId, $ary);
        $auth = Yii::$app->authManager;
        foreach ($ary as $role) {
            $roleObj = self::getPerm($role);
            $auth->assign($roleObj, $userId);
        }
    }

    private static function updateType($userId, $ary) {
        $type = 0;
        if (in_array('business', $ary) || in_array('passafree_staff', $ary) 
                    || in_array('admin', $ary)) {
            $type = 10;
        } else if (in_array('producer', $ary)) {
            $type = 3;
        } else if (in_array('business-analytics', $ary) ||
                   in_array('business-accounting', $ary) ||
                   in_array('business-dashboard', $ary)) {
            $type = 11;
        }
        $user = User::findModel($userId);
        $user->tipo_user = $type;
        $user->save();
    }

    public static function removePermissionOf($userId, $permission) {
        $auth = Yii::$app->authManager;
        $permissionObj = self::getPerm($permission);
        self::updateType($userId, [$permission]);
        $auth->revoke($permissionObj, $userId);
    }

    public function saveProfile() {
        return self::saveProfileOf($this);
    }

    public static function saveProfileOf($user) {
        $p = Profile::find()
            ->where(['user_id' => $user->id])
            ->one();

        if (!$p) {
            $p = new Profile();
            $p->user_id = $user->id;
        }

        $p->name = $user->nome;
        $p->public_email = $user->email;
        $p->save();
        return $p;
    }

    public function setPassword($stream) {
        $this->password_hash = Yii::$app->security
                               ->generatePasswordHash($stream);
    }

    public function updatePermissions($permissions) {
        return self::updatePermissionsOf($this->id, $permissions);
    }

    public function removePermission($permission) {
        return self::removePermissionOf($this->id, $permission);
    }

    /**
     * TODO (ayrton): add support for producers
     */
    public static function getAppUser() {
        $appUser = Yii::$app->user;
        $session = Yii::$app->session;
        $user = [
            'id' => $appUser->identity->id,
            'username' => $appUser->identity->username,
            'business_id' => $session->get('business'),
            'producer_id' => null
        ];

        if ($appUser->can('admin')) {
            $user['role'] = 'admin';
        } else if ($appUser->can('business') ||
            $appUser->can('business-analytics') ||
            $appUser->can('business-dashboard') ||
            $appUser->can('business-accounting')) {
            $user['role'] = 'business';
        } else if ($appUser->can('producer')) {
            $user['role'] = 'producer';
        }

        return $user;
    }

    /**
     * TODO: support more fields of profie
     * TODO 2: use a join instead
     */
    public static function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            $profile = Profile::find()
                       ->where(['user_id'=>$id])
                       ->one();
            if ($profile) {
                $model->nome = $profile->name;
            } else {
                $model->nome = $model->username;
            }
            return $model;
        } else {
            throw new NotFoundHttpException('resource not found.');
        }
    }

    private static function getPerm($permission) {
        $auth = Yii::$app->authManager;
        $permissionObj = $auth->getRole($permission);

        if (!$permissionObj) {
            $msg = "Invalid role ${permission}.";
            throw new NotFoundHttpException($msg);
        }

        return $permissionObj;
    }

    public function getSinglePermission() {
        return RoleAssignment::find()
               ->where(['user_id' => $this->id])
               ->one();
    }

    public static function fetchActive() {
        $data = User::find()->where(['status' => 10])->all();
        return $data;
    }
}

