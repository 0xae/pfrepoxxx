<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

use backend\models\PasswordResetRequestForm;
use common\models\AdminLoginForm;
use backend\models\ResetPasswordForm;
use backend\models\Business;

/**
 * Site controller
 */
class SiteController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        return $this->render('index'); 
    }

    public function actionLogin() {
        $this->layout = 'loginlayout';
        $user = \Yii::$app->user;
        $session = Yii::$app->session;

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ($user->can('admin') || $user->can('passafree_staff')) {
                # humm, what shall we do ?
            } else if($user->can('business')) {
                $b = Business::find()->where(['responsable' => $user->identity->id])->One();
                if ($b) {
                    $session->set('business', $b->id);
                    $session->set('business_name', $b->name);
                }   
            }

            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        Yii::$app->session->destroy();
        return $this->goHome();
    }
}

