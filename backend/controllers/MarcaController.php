<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use backend\models\Marca;
use backend\models\MarcaSearch;
use backend\models\Business;
use backend\models\Produtor;
use backend\models\SignupForm;

/**
 * MarcaController implements the CRUD actions for Marca model.
 */
class MarcaController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'update-produtor', 'create-user'],
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
     * Lists all Marca models.
     * @return mixed
     */
    public function actionIndex() {
        $models = Marca::find()->all();
        $_dataBusiness = ArrayHelper::map(Business::find()->all(), 'id', 'name');

        return $this->render('index', [
            'models' => $models,
            'newMarca' => new Marca(),
            '_dataBusiness' => $_dataBusiness
        ]);
    }

    /**
     * Displays a single Marca model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findMarcaModel($id),
        ]);
    }

    /**
     * Creates a new Marca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Marca();

        if ($model->load(Yii::$app->request->post())) {
            $model->estado = $model::STATUS_ACTIVE;
            if($model->save()){
                return $this->redirect(['update', 'id' => $model->idmarca]);
            } 
        } else {
            $_dataBusiness = ArrayHelper::map(Business::find()->all(), 'id', 'name');
            return $this->render('create', [
                'model' => $model,
                '_dataBusiness' => $_dataBusiness,
                'newMarca' => new Marca()
            ]);
        }
    }

    /**
     * Updates an existing Marca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            /*
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file){
                $ext = end((explode(".", $model->file)));
                $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
                $model->file->saveAs('uploads/marca/'.$generateRandomName);
                $model->logo = 'uploads/marca/'.$generateRandomName;
            }
             */

            if($model->save()){
                return $this->redirect(['update', 'id' => $model->idmarca]);
            }
        } 

        $_dataBusiness = ArrayHelper::map(Business::find()->all(), 'id', 'name');
        $prod = Produtor::find()->where(['marca_idmarca' => $id])->one();
        if (!$prod) {
            $prod = new Produtor();
        } 

        return $this->render('update', [
            'model' => $model,
            'newUser' => new SignupForm(),
            'newProdutor' => $prod,
            '_dataBusiness' => $_dataBusiness,
        ]);
    }

    public function actionUpdateProdutor($id) {
        $model = Produtor::find()->where(['idprodutor' => $id])->One();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->estado = 1;
            $model->save();
            return $this->redirect(['update', 'id' => $model->marca_idmarca]);
        }
    }

    public function actionCreateUser() {
        $model = new SignupForm();
        $model->tipo_user = 3;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $this->addRoles($user, ['business']);
                $prod = new Produtor();
                $prod->idprodutor = $user->id;
                $prod->nome = $model->nome;
                $prod->public_email = $model->email;
                $prod->marca_idmarca = $model->marca_id;

                if (!$prod->save()) {
                    $user->delete();
                    return;
                }

                return $this->redirect(['update', 'id' => $model->marca_id]);
            } else {
                var_dump($model->getErrors());
                return;
            } 
        }
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
     * Deletes an existing Marca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Marca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Marca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Marca::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findMarcaModel($id) {
        if (($model = Marca::find()->where(['idmarca' => $id, 'estado' => 1])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
