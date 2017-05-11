<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

use backend\models\ChatMessage;
use backend\models\Business;

/**
 * ChatController implements the CRUD actions for ChatMessage model.
 */
class ChatController extends Controller {
    public function behaviors() {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'unread', 'index'],
                        'roles' => ['business']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['poll'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all chat messages.
     * @return mixed
     */
    public function actionIndex() {
        $session = \Yii::$app->session;
        $id = $session->get('business');
        $data = ChatMessage::find()
                ->where(['idBusiness' => $id])
                ->all();

        ChatMessage::updateRead($id);
        return $this->render('index', [
            'models' => $data,
        ]);
    }

    public function actionUnread() {
        $session = \Yii::$app->session;
        $id = $session->get('business');
        $data = ChatMessage::find()
                ->where(['idBusiness' => $id])
                ->andWhere('is_read=false')
                ->all();

        ChatMessage::updateRead($id);
        return $this->render('index', [
            'models' => $data,
        ]);
    }

    /**
     * Displays a single ChatMessage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChatMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSend() {
        $model = new ChatMessage();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionPoll() {
       $id = 0;
       $user = \Yii::$app->user;
       if ($user->can('business')) {
           $biz = Business::find()->where(['responsable' => $user->identity->id])->One();
           if ($biz) {
               $id = $biz->id;
               echo json_encode (ChatMessage::countUnread($id));
           }
       } else {
           echo 0;
       }
    }

    /**
     * Deletes an existing ChatMessage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        ChatMessage::findModel($id)->delete();
        return $this->redirect(['index']);
    }
}

