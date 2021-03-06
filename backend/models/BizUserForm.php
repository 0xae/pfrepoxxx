<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\User;
use backend\models\Profile;
use backend\components\FormData;

/**
 * Signup form
 */
class BizUserForm extends Model {
    public $email;
    public $password;
    public $password_confirmation;
    public $permissions;
    public $country_id = null;
    public $business_id = null;
    public $username = null;

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

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

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
        $atIdx = strpos($this->email, '@');
        $user->username = substr($this->email, 0, $atIdx);
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->country_id = $this->country_id;
        $user->password_md5 = md5($this->password);

        $l = $user->save();
        if ($l) {
            $user->saveProfile();
        }
        return new FormData($user, $l);
    }
}

