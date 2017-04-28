<?php
namespace backend\models;

use common\models\User;
use backend\models\Profile;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model {
    public $id=null;
    public $nome;
    public $marca_id;
    public $username;
    public $email;
    public $password;
    public $tipo_user;
    public $permissions;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            /*['nome', 'required'],
            ['apelido', 'required'],
            [['nome', 'apelido'], 'string', 'max' => 100],
            [['nome', 'apelido'], 'safe'],*/
            
            ['tipo_user', 'integer'],
            [['nome', 'marca_id'], 'safe'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }


    public function getUsers(){
        return $model = User::find()->all();
    }

    public function profileIdProfile($id){
        $model = Profile::find()->where(['user_id'=>$id])->one();
        if($model)
            return $model->name;
    }
}
