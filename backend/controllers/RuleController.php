<?php

namespace backend\controllers;

use Yii;
use backend\models\Rule;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RuleController implements the CRUD actions for Rule model.
 */
class RuleController extends Controller {
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
     * Creates a new Rule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Rule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['settings/index', 'view' => 'businessRule']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $i
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['settings/index', 'view' => 'businessRule']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $i
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
    }

    /**
     * Finds the Rule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $i
     * @return Rule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Rule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
