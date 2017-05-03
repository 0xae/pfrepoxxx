<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\LoginForm;
use backend\models\User;
use backend\models\Role;
use backend\models\Country;
use backend\models\Rule;
/**
 * Site controller
 */
class SettingsController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['passafree_staff', 'admin']
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex() {
        $users = User::find()->all();
        $permissions = Role::find()->all();
        $country = Country::find()->all();
        $rules = Rule::find()->all();

        return $this->render('index', [
            'users' => $users,
            'permissions' => $permissions,
            'countries' => $country,
            'rules' => $rules
        ]);
    }
}
