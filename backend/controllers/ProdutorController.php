<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\PasswordResetRequestForm;
use backend\models\Produtor;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;
use backend\models\User;

/**
 * ProdutorController implements the CRUD actions for Produtor model.
 */
class ProdutorController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'update', 'registar', 'profile', 'block', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Produtor models.
     * @return mixed
     */
    public function actionIndex() {
        $data = Produtor::find()->all();
        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionRegistar() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->tipo_user = 3;

            if ($user = $model->signup()) {
                $artista = new Artista();
                $artista->idartista = $user->id;
                $artista->save();
                return $this->redirect(['update', 'id' => $artista->idartista]);
            }
        }

        return $this->render('registar', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Produtor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Produtor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Produtor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Produtor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModelUser($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->password){
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            }

            if($model->save()){
                Yii::$app->session->setFlash('success', "success");
            }
        }

        return $this->render('_update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produtor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Produtor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produtor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Produtor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUser($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
