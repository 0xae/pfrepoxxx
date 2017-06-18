<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\User;
use backend\models\Profile;

/**
 * Signup form
 */
class BizUserForm extends Model {
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $permissions;
    public $tipo_user = 0;
    public $country_id = null;
    public $business_id = null;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['country_id', 'required'],
            ['business_id', 'required'],
            ['permissions', 'required'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_confirmation', 'required'],
            ['password_confirmation', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->tipo_user = $this->tipo_user;
        $user->country_id = $this->country_id;
        $user->password_md5 = md5($this->password);

        if ($user->save()) {
        } else {
            return null;
        }
    }
}

