<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\LoginForm;
use backend\models\Reports;
use backend\models\Business;
use backend\models\AccountingReports;

/**
 * Site controller
 */
class AccountingController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['business-reports', 'producer-reports', 'event-reports',
                                        'business-revenue', 'view-business', 'business', 
                                        'top-producers', 'top-events', 'ticket-reports'],
                        'allow' => true,
                        'roles' => ['passafree_staff', 'admin', 'business']
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['passafree_staff', 'admin', 'business']
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionViewBusiness($id) {
        $biz = $this->getBusiness($id);
        return $this->render('business_profile', ['model' => $biz]);
    }

    public function actionBusiness() {
        $user = Yii::$app->user;
        $biz = $this->getUserBusiness($user->identity->id);
        return $this->render('business_profile', ['model' => $biz]);
    }

    /**
     * Reports API
     */

    public function actionBusinessRevenue(){
        $filter = $this->getBusinessFilters();
        $report = new AccountingReports();
        echo json_encode($report->getBusinessRevenue($filter));
    }

    public function actionTopProducers(){
        $filter = $this->getBusinessFilters();
        $report = new AccountingReports();
        echo json_encode($report->getTopProducers($filter));
    }

    public function actionTicketReports() {
        $filter = $this->getBusinessFilters();
        $report = new AccountingReports();
        echo json_encode($report->getTicketReport($filter));
    }

    public function actionTopEvents(){
        $filter = $this->getBusinessFilters();
        $report = new AccountingReports();
        echo json_encode($report->getTopEvents($filter));
    }

    public function actionBusinessReports() {
        $filter = $this->getTimeFilters();
        $rep = new Reports();
        echo json_encode($rep->getBusinessReport($filter));
    }

    public function actionProducerReports() {
        $filter = $this->getTimeFilters();
        $rep = new Reports();
        echo json_encode($rep->getProducerReport($filter));
    }

    public function actionEventReports() {
        $filter = $this->getTimeFilters();
        $rep = new Reports();
        echo json_encode($rep->getEventsReport($filter));
    }

    /**
     * Helper functions
    */
    private function getTimeFilters() {
        $filter = [
            'start' => $_GET['start'],
            'end' => $_GET['end']
        ];
        return $filter;
    }

    private function getBusinessFilters() {
        $filter = [
            'start' => $_GET['start'],
            'end' => $_GET['end'],
            'business' => $_GET['business']
        ];
        return $filter;
    }

    private function getUserBusiness($userId) {
        $r = Business::find()->where(['responsable' => $userId]);
        return $r->one();
    }

    private function getBusiness($id) {
        if (($model = Business::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
