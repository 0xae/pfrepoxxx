<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\User;
use backend\models\Profile;

/**
 * Signup form
 */
class SignupForm extends Model {
    public $id = null;
    public $tipo_user = 0;
    public $nome;
    public $marca_id;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $permissions;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['nome', 'required'],
            /*
            ['apelido', 'required'],
            [['nome', 'apelido'], 'string', 'max' => 100],
            [['nome', 'apelido'], 'safe'],
            */
            
            ['tipo_user', 'integer'],
            [['nome', 'marca_id'], 'safe'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     */
    public function signup($validate=true) {
        if ($validate && !$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->tipo_user = $this->tipo_user;

        if ($user->save($validate)) {
            $user->saveProfile();
            $this->id = $user->id;
            return $user;
        } else {
            return null;
        }
    }
}

