<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\BizUserForm;
use backend\models\User;

class BizAccessController extends \yii\web\Controller {
    public function actionIndex() {
    }

    public function actionCreate() {
        $model = new BizUserForm();
        $load = $model->load(Yii::$app->request->post());

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($load) {
            $form = $model->signup();
            if ($form->isValid) {
                $data = $form->data;
                User::updatePermissionsOf($data->id, [$model->permissions]);
                echo json_encode([
                    "id" => $data->id,
                    "username" => $data->username,
                    "country_id" => $data->country_id,
                    "permission" => $model->permissions
               ]);
               return;
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($form->data);
    }

    public function actionUpdatePermission($id) {
    }

    public function actionDelete($id)  {
    }
}

