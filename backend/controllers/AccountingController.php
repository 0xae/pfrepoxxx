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
use backend\models\User;
use backend\models\analytics\AccountingModel;
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
        $service = new AccountingModel();
        $session = Yii::$app->session;
        $model = new Business;
        $pieData = [];
        $_data = [];

        if ($session->has('business')) {
            $bizId = $session->get('business');
            $model = $this->findModel($bizId);
            $date = $model->getRange();
            $_data = $service->getAccounting(User::getAppUser(), $date[0], $date[1], $bizId);
        } 

        if (!empty($_data)) {
            $producers = $_data['business_producer_revenue'];
            foreach ($producers as $p) {
                $pieData[] = [
                    'name' => $p['producer_name'],
                    'y' => (int) $p['business_gross_revenue']
                ];
            }
        }

        return $this->render('index', [
            'model' => $model,
            '_data' => $_data,
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

