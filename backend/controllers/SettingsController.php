<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;

/**
 * Site controller
 */
class SettingsController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
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
