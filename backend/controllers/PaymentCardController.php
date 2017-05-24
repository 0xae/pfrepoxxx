<?php
namespace backend\controllers;

use Yii;
use backend\models\PaymentCard;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use backend\models\UploadForm;

/**
 * PaymentCardController implements the CRUD actions for PaymentCard model.
 */
class PaymentCardController extends Controller {
    public function behaviors() {
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
     * Creates a new PaymentCard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PaymentCard();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->uploadFileIfExists($model);
            $model->save();
            return $this->redirect(['settings/index', 'view' => 'paymentChannel']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PaymentCard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->uploadFileIfExists($model);
            $model->save();
            return $this->redirect(['settings/index', 'view' => 'paymentChannel']);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Finds the PaymentCard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentCard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel($id) {
        if (($model = PaymentCard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function uploadFileIfExists($model) {
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file){
            $model->logo = UploadForm::upload($model->file, 'payment-cards');
            $model->save();
        }
    }
}
