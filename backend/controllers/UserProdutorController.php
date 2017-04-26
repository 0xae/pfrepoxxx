<?php

namespace backend\controllers;

use Yii;
use backend\models\UserProdutor;
use backend\models\UserProdutorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;

use backend\models\User;
use backend\models\Produtor;
use backend\models\Marca;


/**
 * UserProdutorController implements the CRUD actions for UserProdutor model.
 */
class UserProdutorController extends Controller {

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
                        'actions' => ['index', 'update', 'create', 'profile', 'block', 'delete'],
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
     * Lists all UserProdutor models.
     * @return mixed
     */
    public function actionIndex() {
        //$models = UserProdutor::getUsersProdutors(Yii::$app->user->identity->id);
        $models = Produtor::getUsersProdutors(Yii::$app->user->identity->id);
        $model = new UserProdutor();

        return $this->render('index', [
            'models' => $models,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single UserProdutor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionBlock($id)
    {
        $model = $this->findModelUser($id);

        if($model->blocked_at){
            
            $model->blocked_at = '';
            $model->save();
            Yii::$app->session->setFlash('success', 'User has been unblocked!');
        }else{

            date_default_timezone_set('Atlantic/Cape_Verde');
            $model->blocked_at = date('Y-m-d', time());
            $model->save();
            Yii::$app->session->setFlash('error', 'User has been blocked!');
        }

            return $this->render('_update', [
                'model' => $model,
            ]);
    }



    public function actionDelete($id)
    {
        

        $model = $this->findModelUser($id);
        $model->status = 0;
        $model->save();

        $produtor = $this->findModelProdutor($id);
        $produtor->estado = 0;
        $produtor->save();

        Yii::$app->session->setFlash('error', 'User has been deleted!');

        
        $models = Produtor::getUsersProdutors(Yii::$app->user->identity->id);
        $model = new UserProdutor();

        return $this->render('index', [
            'models' => $models,
            'model' => $model,
        ]);
    }

    /**
     * Creates a new UserProdutor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            
            $model->tipo_user = 3;

            if ($user = $model->signup()) {

                $produtor = new Produtor();
                $produtor->idprodutor = $user->id;
                $produtor->save();

                return $this->redirect(['update', 'id' => $produtor->idprodutor]);
            }
        }
            return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing UserProdutor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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


    public function actionProfile($id)
    {
        $profile = $this->findModelProdutor($id);
        $model = $this->findModelUser($id);
        $_dataMarca = Marca::getMarcas();

        if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
            Yii::$app->session->setFlash('success', "success");
        }
            return $this->render('_profile', [
                'profile' => $profile,
                'model' => $model,
                '_dataMarca' => $_dataMarca,
            ]);

    }

    /**
     * Deletes an existing UserProdutor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    
    /**
     * Finds the UserProdutor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProdutor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProdutor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUser($id)
    {
        if (($model = User::find()->where(['id' => $id, 'status' => 10])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findModelProdutor($id)
    {
        if (($model = Produtor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
