<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\widgets\ActiveForm;

use backend\models\Marca;
use backend\models\MarcaSearch;
use backend\models\Business;
use backend\models\Produtor;
use backend\models\SignupForm;
use backend\models\UploadForm;
use common\models\User as AppUser;

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
                        'roles' => ['passafree_staff', 'admin', 'business']
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Marca models.
     * @return mixed
     */
    public function actionIndex() {
        $session = Yii::$app->session;
        $user = Yii::$app->user;
        $models = Marca::find();
        $marca = new Marca();

        if ($session->has('business')) {
            $bizId = $session->get('business');
            $models = $models->where(['business_id' => $bizId]);
            $marca->business_id = $bizId;
        } 

        $models = $models->all();
        $_dataBusiness = ArrayHelper::map(Business::find()->all(), 'id', 'name');

        return $this->render('index', [
            'models' => $models,
            'newMarca' => $marca,
            'newUser' => new SignupForm(),
            'newProdutor' => new Produtor(),
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

    public function beforeAction($action) {
        if ($action->id == 'create') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Creates a new Marca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $marca = new Marca();
        $user = new SignupForm();
        $produtor = new Produtor();
        $req = Yii::$app->request->post();

        if ($marca->load($req) && $user->load($req) && $produtor->load($req)) {
            $marca->estado = Marca::STATUS_ACTIVE;
            $user->tipo_user=3;
            $produtor->public_email = $user->email;

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user, $marca, $produtor);
            }

            $marca->file = UploadedFile::getInstance($marca, 'file');
            if ($marca->file){
                $marca->logo = UploadForm::upload($marca->file, 'marca');
            }

            if ($marca->save() && ($us=$user->signup())) {
                $produtor->idprodutor = $us->id;
                $produtor->marca_idmarca = $marca->idmarca;
                if (!$produtor->save()) {
                    $marca->delete();
                    $us->delete();
                    return $this->renderAjax('create_marca', [
                        'newMarca' => $marca,
                        'newUser' => $user,
                        'newProdutor' => $produtor
                    ]);
                } else {
                    return $this->redirect(['update', 'id' => $marca->idmarca]);
                }
            }
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
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file){
                $model->logo = UploadForm::upload($model->file, 'marca');
            }

            if($model->save()){
                return $this->redirect(['update', 'id' => $model->idmarca]);
            }
        } 

        $prod = Produtor::find()->where(['marca_idmarca' => $id])->one();
        if (!$prod) {
            $prod = new Produtor();
            $user = new SignupForm();
        } else {
            $user = AppUser::find()->where(['id' => $prod->idprodutor])->one();
        }

        $_dataBusiness = ArrayHelper::map(Business::find()->all(), 'id', 'name');
        $model->file = $model->logo;
        return $this->render('update', [
            'model' => $model,
            'newUser' => $user,
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
