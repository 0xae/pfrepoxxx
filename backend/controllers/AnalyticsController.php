<?php
namespace backend\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;

use backend\components\RestApp;
use backend\models\UploadForm;
use backend\models\Business;
use backend\models\User;
use backend\models\analytics\DashboardModel;

class AnalyticsController extends \yii\web\Controller {
    public function behaviors() {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'dashboard'],
                        'roles' => ['passafree_staff', 'admin', 'business']
                    ],
                ]
            ]
        ];
    }

    public function actionIndex() {
        return $this->render("index", []);
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

    public function actionProducerAnalytics() {
        $service = new AnalyticsService();
        $session = \Yii::$app->session;
        $biz = $session->get('business');
        $user = \Yii::$app->user;
        $filters = RestApp::parseQueryFilters($_GET);
        $filters[] = [
            'op' => '=',
            'field' => 'business_id',
            'val'  => $biz
        ];

        $d1 = $service->getProducerAnalytics($filters, ['order_by' => 'total_eventos desc']);
        $d2 = $service->getProducerReport($filters, ['order_by' => 'tickets_sold desc']);

        # lets do it man
        foreach ($d2 as &$dk) {
            $field = 'business_revenue';
            if ($user->can('admin') || $user->can('passafree_admin')) {
                $field = 'passafree_revenue';
            } 
            $dk['relative_revenue'] = $dk[$field];
            $dk['relative_revenue_of'] = $field;
        }

        echo json_encode([
            'data' => [
                'eventsPerProducer' => $d1,
                'ticketsPerProducer' => $d2
            ]
        ]);
    }

    public function actionInteractionGrowth() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();
        $session = \Yii::$app->session;
        $filters[] = [
            'op'=>'=', 'field'=>'business_id', 'val'=>$session->get('business')
        ];

        echo json_encode([
            'data' => $service->getReactionGrowth($filters)
        ]);
    }

    public function actionUserGrowth() {
        $filters = RestApp::parseQueryFilters($_GET);
        $service = new AnalyticsService();
        $session = \Yii::$app->session;
        $bizId = $session->get('business');
        if ($bizId) {
            $countryId = Business::find()->where(['id' => $bizId])->one()->country_id;
            $filters[] = [
                'op'=>'=', 'field'=>'country_id', 'val'=>$countryId
            ];
        }

        echo json_encode([
            'data' => $service->getUserGrowth($filters)
        ]);
    }

    private function getQueryParam($param) {
        if (!array_key_exists($param, $_GET) || $_GET[$param] == '') {
            throw new BadRequestHttpException("param $param is required.");
        }

        return $_GET[$param];
    }
}
