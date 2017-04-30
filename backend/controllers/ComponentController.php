<?php
namespace backend\controllers;
use backend\models\UploadForm;
use yii\web\UploadedFile;

class ComponentController extends \yii\web\Controller {
    public function actionIndex() {
        $model = new UploadForm();
        return $this->render('index', ['model'=>$model]);
    }

    public function actionUpload() {
        $model = new UploadForm();
        if (\Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                return;
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}
