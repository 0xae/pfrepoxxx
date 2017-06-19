<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class AdminLoginForm extends Model {
    public $username;
    public $password;
    public $rememberMe = false;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Verifique os seus credenciais.');
            }
            elseif (!$user || $user->blocked_at != "") {
                $this->addError('username', 'Your account has been blocked.');
            }
            elseif (!$user || $user->status==0) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
            elseif (!$user || ($user->tipo_user != 10 && $user->tipo_user != 11)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 20 * 20 * 20 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        $this->_user = Admin::findByUsername($this->username);
        return $this->_user;
    }
}
