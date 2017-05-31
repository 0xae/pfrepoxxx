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
use backend\models\analytics\AnalyticsService;
use backend\components\RestApp;

/**
 * Site controller
 */
class AccountingController extends Controller {
    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex() {
        $session = Yii::$app->session;
        $service = new AnalyticsService();

        if ($session->has('business')) {
            $id = $session->get('business');
            $model = $this->findModel($id);
            $r = $model->getRange();
            $filters = RestApp::parseQueryFilters([
                'business_id' => $id,
                'date' => '$in:'.$r[0].','.$r[1]
            ]);

            $producers = $service->getProducerReport($filters);
            $businessData = $service->getBusinessReport($filters);
        } else {
            $model = new Business;
            $producers = [];
            $businessData = [];
        }

        $pieData = [];
        foreach ($producers as $p) {
            $pieData[] = [
                'name' => $p['producer_name'],
                'y' => (int) $p['business_gross_revenue']
            ];
        }
        $pieData = json_encode($pieData);

        return $this->render('index', [
            'model' => $model,
            'producers' => $producers,
            'businessData' => $businessData,
            'pieData' => $pieData
        ]);
    }

    protected function findModel($id) {
        if (($model = Business::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException("The business with id {$id} does not exist.");
        }
    }
}

