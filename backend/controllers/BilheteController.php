<?php

namespace backend\controllers;

use Yii;
use backend\models\Bilhete;
use backend\models\BilheteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use backend\models\Evento;


/**
 * BilheteController implements the CRUD actions for Bilhete model.
 */
class BilheteController extends Controller {
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
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
     * Lists all Bilhete models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BilheteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bilhete model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bilhete model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Bilhete(['scenario' => Bilhete::SCENARIO_CREATE]);
        $_dataEvento = Evento::getEventos();

        if ($model->load(Yii::$app->request->post())) {

            $model->estado = $model::STATUS_ACTIVE;
            $model->file = UploadedFile::getInstance($model, 'file');
            $ext = end((explode(".", $model->file)));
            $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
            $model->file->saveAs('uploads/bilhete/'.$generateRandomName);
            $model->imagem = 'uploads/bilhete/'.$generateRandomName;

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->idbilhete]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                '_dataEvento' => $_dataEvento,
            ]);
        }
    }

    /**
     * Updates an existing Bilhete model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $_dataEvento = Evento::getEventos();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if($model->file){
                $ext = end((explode(".", $model->file)));
                $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
                $model->file->saveAs('uploads/bilhete/'.$generateRandomName);
                $model->imagem = 'uploads/bilhete/'.$generateRandomName;
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->idbilhete]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                '_dataEvento' => $_dataEvento,
            ]);
        }
    }

    /**
     * Deletes an existing Bilhete model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Bilhete model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bilhete the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Bilhete::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
