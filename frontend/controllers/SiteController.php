<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use backend\models\User;
use backend\models\Evento;
use backend\models\Tipoevento;
use backend\models\Produtor;
use backend\models\Marca;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'create', 'update', 'view', 'index','profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],  


            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
   public function actionIndex()
    {
         

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'loginlayout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
            //return $this->redirect(['evento/index']);

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

	public function actionEditarprofile()
    {


    $model = User::findOne(Yii::$app->user->identity->id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->password){
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            }

            if($model->save()){
                Yii::$app->session->setFlash('success', "success");
            }
        

        }
            return $this->render('profile', [
                'model' => $model,
            ]);


    }

	public function actionUpdate()
    {
        $model = $this->findModelUser(Yii::$app->user->identity->id);
         $modelEvento = new Evento(['scenario' => Evento::SCENARIO_CREATE]);

         $_dataIlhas = $modelEvento->getIlhas();
         $_dataFiltros = $modelEvento->getFiltros();
         $_dataTipoevento = Tipoevento::getTipoeventos();

        if ($model->load(Yii::$app->request->post())) {

            if($model->password){
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            }

            if($model->save()){
                Yii::$app->session->setFlash('success', "success");
            }
        

        }
            return $this->render('_update', [
                'model' => $model,
            'modelEvento'=>$modelEvento,
            '_dataIlhas'=>$_dataIlhas,
            '_dataFiltros'=>$_dataFiltros,
            '_dataTipoevento'=>$_dataTipoevento
            ]);
    }


    public function actionProfile()
    {
        $profile = $this->findModelProdutor(Yii::$app->user->identity->id);
        $model = $this->findModelUser(Yii::$app->user->identity->id);
        $_dataMarca = Marca::getMarcas();
        
        $modelEvento = new Evento(['scenario' => Evento::SCENARIO_CREATE]);

         $_dataIlhas = $modelEvento->getIlhas();
         $_dataFiltros = $modelEvento->getFiltros();
         $_dataTipoevento = Tipoevento::getTipoeventos();

        if ($profile->load(Yii::$app->request->post()) ) {
        
            $profile->foto = UploadedFile::getInstance($profile, 'foto');
                    
                if($profile->foto){
                   
                    $ext = end((explode(".", $profile->foto)));
                    $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
                    $profile->foto->saveAs('uploads/user/'.$generateRandomName);
                    $profile->foto = 'uploads/user/'.$generateRandomName;
                    
                    if($profile->save())
                        Yii::$app->session->setFlash('success', "success");
                 }
        
        
        
            
        }
            return $this->render('_profile', [
                'profile' => $profile,
                'model' => $model,
                '_dataMarca' => $_dataMarca,
            'modelEvento'=>$modelEvento,
            '_dataIlhas'=>$_dataIlhas,
            '_dataFiltros'=>$_dataFiltros,
            '_dataTipoevento'=>$_dataTipoevento
            ]);

    }
	
	protected function findModel($id)
    {
        if (($model = UserProdutor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUser($id)
    {
        if (($model = User::find()->where(['id' => $id, 'status' => 10])->One()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findModelProdutor($id)
    {
        if (($model = Produtor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
