<?php
namespace backend\controllers;
use backend\models\UploadForm;
use backend\models\analytics\ReportsService;
use backend\models\analytics\AnalyticsService;
use backend\components\RestApp;

class AnalyticsController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index', []);
    }

    public function actionApi() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();

        $data = $service->getGlobalReport($filters);
        $data['business_data'] = $service->getBusinessReport($filters);
        $data['producer_data'] = $service->getProducerReport($filters);
        $data['event_data'] = $service->getEventReport($filters);

        echo json_encode ($data);
    }
}

