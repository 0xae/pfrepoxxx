<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PaymentChannel;
use backend\models\PaymentCard;

/**
 * PaymentChannelController implements the CRUD actions for PaymentChannel model.
 */
class PaymentChannelController extends Controller {
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
     * Creates a new PaymentChannel model.
     * FIXME: find a way to return this model back to settings in case of validation errors 
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PaymentChannel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updateCards($model->supported_cards);
            return $this->redirect(['settings/index', 'view' => 'paymentChannel']);
        } else {
            $data = PaymentCard::find()->all();
            $cards = ArrayHelper::map($data, 'id', 'name');
            if (!$model->supported_cards) {
                $model->supported_cards = [];
            }
            return $this->render('create', [
                'model' => $model,
                'cards' => $cards
            ]);
        }
    }

    /**
     * Updates an existing PaymentChannel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updateCards($model->supported_cards);
            return $this->redirect(['settings/index', 'view' => 'paymentChannel']);
        } else {
            $data = PaymentCard::find()->all();
            $cards = ArrayHelper::map($data, 'id', 'name');
            $model->supported_cards =  ArrayHelper::map($model->getCards(), 'id', 'id');

            return $this->render('update', [
                'model' => $model,
                'cards' => $cards
            ]);
        }
    }

    public function actionDelete($id) {
        $model = User::findModel($id);
        $model->status=0;
        $model->save();
    }

    public function actionView($id) {
        $model = $this->findModel($id);
        $cards = [];
        foreach ($model->getCards() as $o) {
            $cards[] = [
                'id' => $o['id'],
                'name' => $o['name'],
                'logo' => $o['logo'],
            ];
        }

        echo json_encode([
            'id' => $id,
            'name' => $model->name,
            'link' => $model->link,
            'accepted_cards' => $cards
        ]);
    }

    /**
     * Finds the PaymentChannel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentChannel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PaymentChannel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
