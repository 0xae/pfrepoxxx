<?php
namespace backend\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\behaviors\TimestampBehavior;

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
            [['status', 'tipo_user', 'created_at', 'updated_at'], 'integer'],
            [['nome', 'username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['password', 'string', 'min' => 6],
            [['tipo_user'], 'safe']
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
        if (in_array('business', $ary)) {
            $type = 10;
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

    public function saveProfileOf($user) {
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

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
}

