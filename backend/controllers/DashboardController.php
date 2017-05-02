<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\Dashboard;

class DashboardController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionAdminDashboard() {
        $d = new Dashboard();
        echo json_encode($d->adminDashboard());
    }

    public function actionBusinessDashboard($businessId) {
    }
}


