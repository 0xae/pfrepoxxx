<?php

namespace backend\controllers;

use Yii;
use backend\models\Business;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use backend\models\Country;
use backend\models\User;
use backend\models\AddProducerForm;

/**
 * BusinessController implements the CRUD actions for Business model.
 */
class BusinessController extends Controller {
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
                        'actions' => ['index', 'create', 'select'],
                        'roles' => ['passafree_staff', 'admin']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update'],
                        'roles' => ['passafree_staff', 'admin', 'business']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Business models.
     * @return mixed
     */
    public function actionIndex() {
        $data = Business::find()->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Business model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $this->verifyAccess($model);
        return $this->render('view', [
            'model' => $model 
        ]);
    }

    /**
     * Creates a new Business model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Business();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->updateResponsable($model->responsable);
            Yii::$app->getSession()->setFlash('success', 'Business criado com sucesso.');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $data = Country::find()->asArray()->all();
            $countries = ArrayHelper::map($data, 'id', 'name');
            $_dataUsers = ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');
            
            return $this->render('create', [
                'model' => $model,
                'producerForm' => [],
                '_dataUsers' => $_dataUsers,
                '_dataCountries' => $countries,
                '_dataProducers' => []
            ]);
        }
    }

    /**
     * Updates an existing Business model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $this->verifyAccess($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->updateResponsable($model->responsable);
            Yii::$app->getSession()->setFlash('success', 'Business actualizado com sucesso.');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $data = Country::find()->asArray()->all();
            $countries = ArrayHelper::map($data, 'id', 'name');
            $_dataUsers = ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');

            return $this->render('update', [
                'model' => $model,
                '_dataUsers' => $_dataUsers,
                '_dataCountries' => $countries,
            ]);
        }
    }

    public function actionSelect($id) {
        $session = Yii::$app->session;
        $model = $this->findModel($id);
        $session->set('business', $id);
        $session->set('business_name', $model->name);
    }

    public function actionRemoveProducer($id) {
        $b = (new Business())->getProducerById($id);
        (new Business())->removeProducer($id);
        return $this->redirect(['update', 'id' => $b['business_id']]);
    }

    public function actionAddProducer() {
        $model = new AddProducerForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
        }

        return $this->redirect(['update', 'id' => $model->business_id]);
    }

    public function verifyAccess($model) {
        if (!Yii::$app->user->can('admin')) {
            if ($model->responsable != Yii::$app->user->identity->id) {
                throw new ForbiddenHttpException('Acesso negado ao objecto.');
            }
        }
    }

    /**
     * Deletes an existing Business model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    private function updateResponsable($id) {
        $auth = Yii::$app->authManager;
        if (!$auth->checkAccess($id, 'business')) {
            User::findModel($id)->addPermission('business');
        }
    }

    /**
     * Finds the Business model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Business the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Business::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
