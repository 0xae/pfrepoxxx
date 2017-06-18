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

    public function actionValidate() {
        $model = new BizUserForm();
        $model->load(Yii::$app->request->post());
        $atIdx = strpos($model->email, '@');
        $model->username = substr($model->email, 0, $atIdx);
        Yii::$app->response->format = Response::FORMAT_JSON;
        $validations = ActiveForm::validate($model);
        if (array_key_exists('bizuserform-username', $validations)) {
            $validations['bizuserform-email'] = $validations['bizuserform-username'];
            unset($validations['bizuserform-username']);
        }
        return $validations;
    }

    public function actionCreate() {
        $model = new BizUserForm();
        $load = $model->load(Yii::$app->request->post());

        if ($load) {
            $form = $model->signup();
            $data = $form->data;
            if ($form->isValid) {
                User::updatePermissionsOf($data->id, [$model->permissions]);
                echo json_encode([
                    "id" => $data->id,
                    "username" => $data->username,
                    "email" => $data->email,
                    "country_id" => $data->country_id,
                    "permission" => $model->permissions
                ]);
                return;
            } 
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $validations =  ActiveForm::validate($load? $form->data : $model);
        if (array_key_exists('user-username', $validations)) {
            $validations['bizuserform-email'] = $validations['user-username'];
            unset($validations['user-username']);
        }
        return $validations;
    }

    public function actionDelete($id) {
        $model = User::findModel($id);
        $model->revokeAll();
        $model->delete();
    }
}

