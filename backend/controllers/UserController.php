<?php

namespace backend\controllers;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use backend\models\SignupForm;
use backend\models\User;
use backend\models\Country;
use backend\models\RoleAssignment;
use backend\models\Role;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'view'],
                        'roles' => ['passafree_staff', 'admin'] 
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $data = User::find()->all();
        return $this->render('index', [
            'data' => $data
        ]);
    }

    /**
     * Creates a new User model.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                User::updatePermissionsOf($user->id, $this->getRequestPermissions());
                return $this->redirect(['settings/index']);
            }
        }

        $model->permissions = [];
        $permissionData = ArrayHelper::map(Role::find()->all(),'name','name');
        $countryData = ArrayHelper::map(Country::find()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'userPermissions' => [],
            '_dataPermissions' => $permissionData,
            '_dataCountry' => $countryData
        ]);
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $auth = Yii::$app->authManager;
        $model = User::findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->updatePermissions($this->getRequestPermissions());
            $model->saveProfile();
            if ($model->password) {
                $model->setPassword($model->password);
            }

            if ($model->save())
                return $this->redirect(['settings/index']);
        } 

        $countryData = ArrayHelper::map(Country::find()->all(), 'id', 'name');
        $permissionData = ArrayHelper::map(Role::find()->all(),'name','name');
        $userPermissions = ArrayHelper::map($auth->getRolesByUser($model->id), 'name', 'name');
        $model->permissions = $userPermissions;

        return $this->render('update', [
            'model' => $model,
            'userPermissions' => $userPermissions,
            '_dataPermissions' => $permissionData,
            '_dataCountry' => $countryData
        ]);
    }

    private function getRequestPermissions() {
        $data = Yii::$app->request->post();
        if (array_key_exists('permissions', $data)) {
            return $data['permissions'];
        }
        return [];
    }
}


