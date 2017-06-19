<?php
namespace backend\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;

use backend\components\RestApp;
use backend\models\UploadForm;
use backend\models\Business;
use backend\models\Country;
use backend\models\User;
use backend\models\analytics\DashboardModel;
use backend\models\analytics\AnalyticsModel;

class AnalyticsController extends \yii\web\Controller {
    public function behaviors() {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'dashboard', 'analytics-data'],
                        'roles' => ['passafree_staff', 'admin', 'business', 'business-analytics', 'business-accounting', 'business-producer']
                    ],
                ]
            ]
        ];
    }

    public function actionIndex() {
        $model = new Business;
        $country = new Country;
        $bizId = \Yii::$app->session->get('business');

        if ($bizId) {
            $model = Business::findModel($bizId);
            $country = Country::findModel($model->country_id);
        }

        return $this->render("index", [
            'model' => $model,
            'country' => $country
        ]);
    }

    public function actionDashboard() {
        $s = new DashboardModel(); 
        $appUser = User::getAppUser();
        $start = $this->getQueryParam("start");
        $end = $this->getQueryParam("end");

        echo json_encode([
            "revenue" => $s->getRevenueData($appUser, $start, $end),
            "resume" => $s->getResume($appUser, $start, $end)
        ]);
    }

    public function actionAnalyticsData() {
        $s = new AnalyticsModel(); 
        $appUser = User::getAppUser();
        $start = $this->getQueryParam("start");
        $end = $this->getQueryParam("end");
        $bizId = $appUser['business_id'];

        if (!$bizId) {
            echo json_encode([]);
            die;
        }

        $model = Business::findModel($bizId);
        echo json_encode([
            'user_statistics' => $s->getUserStatistics($appUser, $start, $end, $model->country_id, $bizId),
            'producer_statistics' => $s->getProducerStatistics($appUser, $start, $end, $bizId)
        ]);
    }

    private function getQueryParam($param) {
        if (!array_key_exists($param, $_GET) || $_GET[$param] == '') {
            throw new BadRequestHttpException("param $param is required.");
        }

        return $_GET[$param];
    }
}
