<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

use backend\models\Evento;
use backend\models\EventoSearch;
use backend\models\Tipoevento;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller {
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
                    'delete' => ['get','post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex() {
        $models = Evento::getAllEventos();
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'models' => $models,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Evento model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            '_dataBilhetes' => $model->getBilhetes() 
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Evento(['scenario' => Evento::SCENARIO_CREATE]);
        $_dataIlhas = $model->getIlhas();
        $_dataFiltros = $model->getFiltros();
        $_dataTipoevento = Tipoevento::getTipoeventos();

        if ($model->load(Yii::$app->request->post())) {
            $model->estado = $model::STATUS_ACTIVE;
            $model->produtor_idprodutor = Yii::$app->user->identity->id;
            $model->file = UploadedFile::getInstance($model, 'file');
            $ext = end((explode(".", $model->file)));
            $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
            $model->file->saveAs('uploads/evento/'.$generateRandomName);
            $model->cartaz = 'uploads/evento/'.$generateRandomName;

            if($model->validate()) {
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->idevento]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            '_dataIlhas' => $_dataIlhas,
            '_dataFiltros' => $_dataFiltros,
            '_dataTipoevento' => $_dataTipoevento,
        ]);
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $_dataIlhas = $model->getIlhas();
        $_dataFiltros = $model->getFiltros();
        $_dataTipoevento = Tipoevento::getTipoeventos();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file){
                $ext = end((explode(".", $model->file)));
                $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
                $model->file->saveAs('uploads/evento/'.$generateRandomName);
                $model->cartaz = 'uploads/evento/'.$generateRandomName;
            }

            if($model->validate()) {
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->idevento]);
                }
            }
        } 

        return $this->render('update', [
            'model' => $model,
            '_dataIlhas' => $_dataIlhas,
            '_dataFiltros' => $_dataFiltros,
            '_dataTipoevento' => $_dataTipoevento,
        ]);
    }

    /**
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
