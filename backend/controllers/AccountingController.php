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

}
