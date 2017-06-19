<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use backend\models\AddProducerForm;
use backend\models\Business;
use backend\models\Country;
use backend\models\Marca;
use backend\models\PaymentChannel;
use backend\models\User;
use backend\models\Role;
use backend\models\UploadForm;

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
                        'actions' => ['index', 'update', 'privacy'],
                        'roles' => ['passafree_staff', 'admin', 'business']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete', 'update', 'create', 'update', 'select', 'privacy'],
                        'roles' => ['passafree_staff', 'admin']
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
        return $this->render('index', ['data' => $data]);
    }

    /**
     * Creates a new Business model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Business();
        $this->uploadFileIfExists($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } 

        $data = Country::find()->where(['business_id' => null])->asArray()->all();
        $countries = ArrayHelper::map($data, 'id', 'name');
        $paymentChannels = ArrayHelper::map(PaymentChannel::find()->asArray()->all(), 'id', 'name');
        $_dataUsers = Business::getResponsableSugestions();

        return $this->render('create', [
            'model' => $model,
            'producerForm' => [],
            'paymentChannels' => $paymentChannels,
            '_dataUsers' => $_dataUsers,
            '_dataCountries' => $countries,
            '_dataProducers' => []
        ]);
    }

    /**
     * Updates an existing Business model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = Business::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->uploadFileIfExists($model);
            $model->save();
            return $this->redirect(['business/index']);
        } 

        $data = [$model->getCountry()];
        $countries = ArrayHelper::map($data, 'id', 'name');
        $_dataUsers = ArrayHelper::map([User::findModel($model->responsable)], 'id', 'nome');
        $_data = PaymentChannel::find()->all();
        $paymentChannels = ArrayHelper::map($_data, 'id', 'name');
        $permissionData = [
            # 'business' => 'business',
            'business-analytics' => 'business-analytics',
            'business-accounting' => 'business-accounting',
            'business-producer' => 'business-producer',
        ];

        $_dataAccess = User::find()
                       ->where([
                           'status' => 10,
                           'tipo_user' => 11,
                           'country_id' => $model->country_id
                       ])
                       ->all();

        return $this->render('update', [
            'model' => $model,
            'producers' => $model->getProducers(),
            'paymentChannels' => $paymentChannels,
            '_dataUsers' => $_dataUsers,
            '_dataCountries' => $countries,
            '_dataPermissions' => $permissionData,
            '_dataAccess' => $_dataAccess
        ]);
    }

    /**
     * privacy text for this business
     */
    public function actionPrivacy($id) {
        $biz = Business::findModel($id);
        echo $biz->privacy_content;
    }

    /**
     * deactivates the business
     * admin only
     */
    public function actionDelete($id) {
        $model = Business::findModel($id);
        $model->is_active = false;
        $model->save();
        return $this->redirect(['index']);
    }

    private function uploadFileIfExists($model) {
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file){
            $model->picture = UploadForm::upload($model->file, 'business');
        }
    }
}

