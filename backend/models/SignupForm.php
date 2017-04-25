<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use backend\models\Role;

/**
 * Signup form
 */
class SignupForm extends Model {
    public $username;
    public $email;
    public $password;
    public $country_id;
    public $permissions;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este utilizador nao esta disponivel.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este email nao esta disponivel.'],

            ['country_id', 'required'],
            ['permissions', 'safe'],

            ['password', 'required', 'message' => 'A password e obrigatoria'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->country_id = $this->country_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
