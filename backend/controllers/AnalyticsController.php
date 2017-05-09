<?php
namespace backend\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\UploadForm;
use backend\models\Business;
use backend\models\analytics\ReportsService;
use backend\models\analytics\AnalyticsService;
use backend\components\RestApp;

class AnalyticsController extends \yii\web\Controller {
    /*
    public function behaviors() {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'dashboard', 'business', 'event', 'producer'],
                        'roles' => ['passafree_staff', 'admin', 'business', 'producer']
                    ],
                ]
            ]
        ];
    }
     */

    public function actionIndex() {
        $service = new AnalyticsService();
        $session = \Yii::$app->session;
        $biz = $session->get('business');
        if (!$biz) {
            $biz = -1;
        }

        $filters = [
            [
                'op' => '=',
                'field' => 'business_id',
                'val'  => $biz 
            ]
        ];

        $d1 = $service->getProducerAnalytics($filters, ['order_by' => 'total_eventos desc']);
        $d2 = $service->getProducerReport($filters, ['order_by' => 'tickets_sold desc']);
        $data = [
            'eventsPerProducer' => $d1,
            'ticketsPerProducer' => $d2
        ];

        return $this->render('index', $data);
    }

    public function actionDashboard() {
        $user = \Yii::$app->user;
        $session = \Yii::$app->session;
        $service = new AnalyticsService();

        /*
         * TODO: make this code prettier
         * XXX: work on these filters
        */
        $globalRevenue=0;

        if ($user->can('business')) {
            $businessId  = $session->get('business');
            $_GET['business_id'] = $businessId;
            $globalRevenue = $service->getBusinessRevenue(['business_id' => $businessId]);
        } else if ($user->can('producer')) {
            $producerId = Produtor::find()->where(['idprodutor'=>$user->id])->one()->marca_idmarca;
            $_GET['producer_id'] = $producerId;
            $globalRevenue = $service->getProducerRevenue(['producer_id' => $producerId]);
        } else {
            $globalRevenue = $service->getPassaFreeRevenue([]);
        }

        $filters = RestApp::parseQueryFilters($_GET);

        $data = $service->getDashboardReport($filters);
        $data['business_data'] = $service->getBusinessReport($filters);
        $data['producer_data'] = $service->getProducerReport($filters);
        $data['event_data'] = $service->getEventReport($filters);
        $data['global_revenue'] = $globalRevenue;

        echo json_encode ($data);
    }

    public function actionBusiness() {
        $filters = [];
        $service = new AnalyticsService();

        echo json_encode([
            'data' => $service->getBusinessReport($filters)
        ]);
    }

    public function actionProducer() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();

        echo json_encode([
            'data' => $service->getProducerReport($filters)
        ]);
    }

    public function actionProducerAnalytics() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();

        echo json_encode([
            'data' => $service->getProducerAnalytics($filters)
        ]);
    }

    public function actionEvent() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();

        echo json_encode([
            'data' => $service->getEventReport($filters)
        ]);
    }

    public function actionUser() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();

        echo json_encode([
            'data' => $service->getUserGrowth($filters)
        ]);
    }

    public function actionReactions() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();

        echo json_encode([
            'data' => $service->getReactionGrowth($filters)
        ]);
    }


    public function actionTicket() {
        $filters = [];
        $service = new AnalyticsService();

        echo json_encode([
            'data' => $service->getTicketReport($filters)
        ]);
    }
}
