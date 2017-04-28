<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AnalyticsController extends \yii\web\Controller {
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

    public function actionIndex() {
        return $this->render('index');
    }
}

