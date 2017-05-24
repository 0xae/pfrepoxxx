<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\widgets\ActiveForm;

use backend\models\Marca;
use backend\models\MarcaSearch;
use backend\models\Business;
use backend\models\Produtor;
use backend\models\SignupForm;
use backend\models\UploadForm;
use backend\models\Evento;
use backend\models\User;
use backend\components\FormData;
use backend\models\analytics\EventReport;

/**
 * MarcaController implements the CRUD actions for Marca model.
 */
class MarcaController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'update-produtor', 'create-user'],
                        'roles' => ['passafree_staff', 'admin', 'business'],
                        'allow' => true
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Marca models.
     * @return mixed
     */
    public function actionIndex() {
        $session = Yii::$app->session;
        $user = Yii::$app->user;
        $models = Marca::find();
        $marca = new Marca();

        if ($session->has('business')) {
            $bizId = $session->get('business');
            $models = $models->where(['business_id' => $bizId]);
            $marca->business_id = $bizId;
        } 

        $models = $models->all();
        $_dataBusiness = ArrayHelper::map(Business::find()->all(), 'id', 'name');

        return $this->render('index', [
            'models' => $models,
            'newMarca' => $marca,
            'newUser' => new SignupForm(),
            'newProdutor' => new Produtor(),
            '_dataBusiness' => $_dataBusiness
        ]);
    }

    /**
     * Displays a single Marca model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $service = new EventReport();
        $marca = Marca::findModel($id);
        $events = $marca->getNextEvents();
        $prod = $marca->getProdutor();
        $destaque = null;

        /**
         * XXX: here is the formula for entrada:
         *      Entrada = <total_cheched_id> / <total sold>
         */
        $ret = [];
        if (!empty($events)) {
            # the most recent
            $destaque = array_shift($events);
            $ret = $service->getReportById(User::getAppUser(), $destaque->idevento);
        }

        return $this->render('view', [
            'model' => $marca,
            'produtor' => $prod,
            'destaque' => $destaque,
            'stats' => $ret,
            'nextEvents' => $events
        ]);
    }

    public function beforeAction($action) {
        if ($action->id == 'create') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * Creates a new Marca model.
     * FIXME: ho
     * @return mixed
     */
    public function actionCreate() {
        
        $req = Yii::$app->request->post();
        $marca = $this->getMarca($req);
        $user = $this->getUser($req, $marca->data);
        $produtor = $this->getProdutor($req, $user->data, $marca->data);

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user->data, $marca->data, $produtor->data);
        }

        $this->uploadFileIfExists($marca->data);
        if ($user->isValid && $marca->isValid && $produtor->isValid) {
            if ($this->saveThem($user, $marca, $produtor)) {
                return $this->redirect(['index']);
            }
        } 

        $this->deleteAll($user->data, $marca->data, $produtor->data);

        return $this->render('index', [
            'newMarca' => $marca->data,
            'newUser' => $user->data,
            'newProdutor' => $produtor->data,
            'models' => Business::getProducersFromSession(),
            '_dataBusiness' => ArrayHelper::map(Business::find()->all(), 'id', 'name')
        ]);
    }

    /**
     * Updates the model
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = Marca::findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->uploadFileIfExists($model);
            if($model->save()){
                return $this->redirect(['index']);
            }
        } 

        $prod = Produtor::find()->where(['marca_idmarca' => $id])->one();
        if (!$prod) {
            $prod = new Produtor();
            $user = new SignupForm();
        } else {
            $user = User::find()->where(['id' => $prod->idprodutor])->one();
        }

        $_dataBusiness = ArrayHelper::map(Business::find()->all(), 'id', 'name');
        return $this->render('update', [
            'model' => $model,
            'newUser' => $user,
            'newProdutor' => $prod,
            '_dataBusiness' => $_dataBusiness,
        ]);
    }

    /**
     * deletes the marca
     * @author ayrton
    */
    public function actionDelete($id) {
        Marca::findModel($id)->delete();
        return $this->redirect(['index']);
    }
    
    /**
     * uploads the marca file
     * @author ayrton
    */
    private function uploadFileIfExists($model) {
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file){
            $model->logo = UploadForm::upload($model->file, 'marca');
        }
    }

    /**
     * XXX
     * helpers to create a producer
     * they are very much self explanatory
     * so no need for excessive comments here
     * @author ayrton
    */
    private function saveThem($user, $marca, $produtor) {
        if ($marca->data->save()) {
            if ($signupData = $user->data->signup(false)) {
                $produtor->data->idprodutor = $signupData->id;
                $produtor->data->sexo = "{$signupData->id}";
                $produtor->data->marca_idmarca = $marca->data->idmarca;
                if ($produtor->data->save()) {
                    return true;
                }
            }
        }
        return false;
    }

    private function deleteAll($user, $marca, $produtor) {
        # xxx
        $u=User::find()->where(['id' => $user->id])->one();
        if ($u && $u->delete());

        $m = Marca::find()->where(['idmarca' => $marca->idmarca])->one();
        if ($m && $m->delete());

        $p = Produtor::find()->where(['idprodutor' => $produtor->idprodutor])->one();
        if ($p && $p->delete());
    }

    private function getMarca($request) {
        $marca = new Marca();
        $marca->estado = Marca::STATUS_ACTIVE;
        return new FormData($marca, $marca->load($request));
    }

    private function getUser($request, $marca) {
        $user = new SignupForm();
        $user->tipo_user = 3;
        $user->country_id=Business::find()
                        ->where(['id'=>$marca->business_id])
                        ->one()
                        ->country_id;
        $l = $user->load($request);
        return new FormData($user, $l);
    }

    private function getProdutor($request, $user, $marca) {
        $produtor = new Produtor();
        $produtor->public_email = $user->email;
        $produtor->idprodutor = $user->id;
        $produtor->marca_idmarca = $marca->idmarca;
        $user->nome = $produtor->nome;
        return new FormData($produtor, $produtor->load($request));
    }
}

