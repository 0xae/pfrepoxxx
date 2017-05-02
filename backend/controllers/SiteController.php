<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\AdminLoginForm;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;
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
                        'actions' => ['logout', 'index', 'signup'],
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


     public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
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
                } else {
                    $session->set('business', -1);
                }
            }

            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
