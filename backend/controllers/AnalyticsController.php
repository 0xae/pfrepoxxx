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
        $user = \Yii::$app->user;
        $session = \Yii::$app->session;
        $filters = RestApp::parseQueryFilters($_GET);

        if ($user->can('business')) {
            $filters['business_id'] = $session->get('business');
        } else if ($user->can('producer')) {
            $filters['producer_id'] = Produtor::find()->where(['idprodutor'=>$user->id])->one()->marca_idmarca;
        }


        $service = new AnalyticsService();

        $data = $service->getGlobalReport($filters);
        $data['business_data'] = $service->getBusinessReport($filters);
        $data['producer_data'] = $service->getProducerReport($filters);
        $data['event_data'] = $service->getEventReport($filters);

        echo json_encode ($data);
    }
}

