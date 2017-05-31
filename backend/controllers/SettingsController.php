<?php
namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

use backend\models\LoginForm;
use backend\models\User;
use backend\models\Role;
use backend\models\Country;
use backend\models\Rule;
use backend\models\Evento;
use backend\models\Tipoevento;
use backend\models\Location;
use backend\models\PaymentChannel;
use backend\models\PaymentCard;
use backend\models\Faq;

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
                        'actions' => ['location','updatelocation'],
                        'allow' => true,
                        'roles' => ['business', 'passafree_staff', 'admin']
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['passafree_staff', 'admin']
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
        $users = User::fetchActive();
        $country = Country::fetchActive();
        $paymentChannels = PaymentChannel::fetchActive();

        $permissions = Role::find()->all();
        $rules = Rule::find()->all();
        $faqs = Faq::find()->all();
        $paymentCards = PaymentCard::find()->all();

        return $this->render('index', [
            'users' => $users,
            'permissions' => $permissions,
            'countries' => $country,
            'rules' => $rules,
            'paymentChannels' => $paymentChannels,
            'paymentCards' => $paymentCards,
            'faqs' => $faqs
        ]);
    }
    
    public function actionLocation() {
        $modelEvento = new Evento(['scenario' => Evento::SCENARIO_CREATE]);
        $Location = new Location();
        $_dataIlhas = Location::getLocation();
        $_dataFiltros = $modelEvento->getFiltros();
        $_dataTipoevento = Tipoevento::getTipoeventos();

        $modelLocation = (new \yii\db\Query())
            ->select(['l.idlocation', 'l.nome'])
            ->from('location l')
            ->where(['l.bussiness_id'=>3]);

        $pages = new Pagination(['totalCount' => $modelLocation->count(), 'pageSize'=>15]);
        $modelsLocation = $modelLocation->offset($pages->offset)
            ->groupBy('nome')
            ->orderBy(['idlocation' => SORT_ASC])
            ->limit($pages->limit)
            ->where(['bussiness_id'=>Yii::$app->session['business']])
            ->all();

        if ($Location->load(Yii::$app->request->post())) {
            $Location->bussiness_id = Yii::$app->session['business'];
            $Location->data_log = date('Y-m-d H:m:s', time());

            if ($Location->save()) {
                return $this->redirect(['location']);
            }
        } else {
            return $this->render('location', [
                'modelsLocation' => $modelsLocation,
                'pages' => $pages,
                'Location' => $Location,
                'modelEvento'=>$modelEvento,
                '_dataIlhas'=>$_dataIlhas,
                '_dataFiltros'=>$_dataFiltros,
                '_dataTipoevento'=>$_dataTipoevento
            ]);
        }

        return $this->render('location', [
            'modelsLocation' => $modelsLocation,
            'pages' => $pages,
            'Location' => $Location,
            'modelEvento'=>$modelEvento,
            '_dataIlhas'=>$_dataIlhas,
            '_dataFiltros'=>$_dataFiltros,
            '_dataTipoevento'=>$_dataTipoevento
        ]);
    }
    
    public function actionUpdatelocation(){
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('idlocation');
            $nome = Yii::$app->request->post('nome');
            $model = Location::find()->where(['idlocation'=>$id])->one();
            $model->nome=$nome;

            if (Yii::$app->request->isPost) {
                if ($model->save()) {
                    echo '1';
                }else{
                    echo '0';
                }
            }
        }
    }
}
