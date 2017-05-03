<?php
namespace backend\controllers;
use backend\models\UploadForm;
use backend\models\analytics\ReportsService;

class AnalyticsController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index', []);
    }

    public function actionDashboardBusiness() {
        $service = new ReportsService();
        $filters = [];
        echo json_encode($service->dashboardReports($filters));
    }

    public function actionEventsPerBusiness() {
        $service = new ReportsService();
        $filters = [];
        echo json_encode($service->eventsPerBusiness($filters));
    }

    public function actionSalesPerBusiness() {
        $service = new ReportsService();
        $filters = [];
        echo json_encode($service->salesPerBusiness($filters));
    }

    public function actionSalesPerProducer() {
        $service = new ReportsService();
        $filters = [];
        echo json_encode($service->salesPerProducer($filters));
    }

    public function actionSalesPerEvent() {
        $service = new ReportsService();
        $filters = [];
        echo json_encode($service->salesPerEvent($filters));
    }

    public function actionSalesPerBilhete() {
        $service = new ReportsService();
        $filters = [];
        echo json_encode($service->salesPerBilhete($filters));
    }
}
