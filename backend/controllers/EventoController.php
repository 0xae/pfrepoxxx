<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

use backend\models\Evento;
use backend\models\EventoSearch;
use backend\models\Tipoevento;
use backend\models\User;
use backend\models\analytics\RevenueReport;

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
        $appUser = User::getAppUser();
        $start =  $this->getQueryParam('start', date('Y-01-01'));
        $end =  $this->getQueryParam('end', date("Y-12-31"));

        $tickets = (new RevenueReport)->getRevenuePerTicket($appUser, $start, $end, $id);
        $events = (new RevenueReport)->getRevenuePerEvent($appUser, $start, $end, $id);

        return $this->render('view', [
            'model' => $model,
            '_dataTickets' => $tickets,
            '_dataEvent' => $events[0]
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

    private function getQueryParam($param, $defaultValue=null) {
        if (!array_key_exists($param, $_GET) || $_GET[$param] == '') {
            if ($defaultValue) { return $defaultValue; }
            throw new BadRequestHttpException("param $param is required.");
        }

        return $_GET[$param];
    }
}
