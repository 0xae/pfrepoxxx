<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\Country;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller {
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'roles' => ['passafree_staff', 'admin']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Country::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Country model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', ['model' => Country::findModel($id)]);
    }

    public function actionDelete($id) {
        $model = Country::findOne($id);
        $model->is_active = false;
        $model->save();
    }

    /**
     * Creates a new Country model.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Country();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['settings/index', 'view' => 'countryTab']);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing Country model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = Country::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['settings/index', 'view' => 'countryTab']);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }
}

