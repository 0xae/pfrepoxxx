<?php
namespace backend\controllers;

use Yii;
use backend\models\Tipoevento;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipoeventoController implements the CRUD actions for Tipoevento model.
 */
class TipoeventoController extends Controller {
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tipoevento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tipoevento::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tipoevento model.
     * @param integer $i
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tipoevento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tipoevento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['settings/index', 'view' => 'eventType']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tipoevento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $i
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['settings/index', 'view' => 'eventType']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tipoevento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $i
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->estado = Tipoevento::STATUS_INACTIVE;
        $model->save();
    }

    /**
     * Finds the Tipoevento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $i
     * @return Tipoevento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tipoevento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
