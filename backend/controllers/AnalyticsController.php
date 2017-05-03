<?php
namespace backend\controllers;
use backend\models\UploadForm;
use backend\models\analytics\ReportsService;

class AnalyticsController extends \yii\web\Controller {
    public function actionDashboardBusiness() {
        $service = new ReportsService();
        $filters = [];
        echo json_encode($service->dashboardReports($filters));
    }
}
