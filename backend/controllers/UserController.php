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
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $this->addRoles($user, $this->getRequestPermissions());
                Yii::$app->getSession()->setFlash('success', 'Utilizador criado com sucesso.');
                return $this->redirect(['update', 'id'=>$user->id]);
            }
        }

        $model->permissions = [];
        $permissionData = ArrayHelper::map(Role::find()->all(),'name','name');

        return $this->render('create', [
            'model' => $model,
            'userPermissions' => [],
            '_dataPermissions' => $permissionData
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $auth = Yii::$app->authManager;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $this->updateRoles($model, $this->getRequestPermissions());
            if ($model->password) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            }

            $model->save();
            Yii::$app->getSession()->setFlash('success', 'Utilizador actualizado com sucesso.');
            return $this->redirect(['update', 'id'=>$model->id]);
        } else {
            $data = Country::find()->asArray()->all();
            $permissionData = ArrayHelper::map(Role::find()->all(),'name','name');
            $userPermissions = ArrayHelper::map($auth->getRolesByUser($model->id), 'name', 'name');
            $model->permissions = ArrayHelper::map($auth->getRolesByUser($model->id), 'name', 'name');

            return $this->render('update', [
                'model' => $model,
                'userPermissions' => $userPermissions,
                '_dataPermissions' => $permissionData
            ]);
        }
    }

    private function getRequestPermissions() {
        $postData = Yii::$app->request->post();
        if (array_key_exists('permissions', $postData)) {
            return $postData['permissions'];
        }
        return [];
    }

    private function updateRoles($user, $newRolesArray) {
        RoleAssignment::deleteAll('user_id = :id', ['id' => $user->id]);
        $this->addRoles($user, $newRolesArray);
    }

    private function addRoles($user, $rolesArray) {
        $auth = Yii::$app->authManager;
        foreach($rolesArray as $roleName) {
            $roleObj = $auth->getRole($roleName);
            if (!$roleObj) {
                throw new NotFoundHttpException("Invalid role ${roleName}.");
            }
            $auth->assign($roleObj, $user->id);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
