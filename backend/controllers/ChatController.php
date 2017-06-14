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
                        'actions' => ['index', 'unread', 'poll', 'from'],
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

    public function actionIndex() {
        $session = \Yii::$app->session;
        $bizId = $session->get('business');
        $data = ChatMessage::fetchBizMessages($bizId);
        ChatMessage::updateRead($bizId);

        return $this->render('index', [
            'models' => $data,
        ]);
    }

    public function actionUnread() {
        $session = \Yii::$app->session;
        $bizId = $session->get('business');
        $data = ChatMessage::fetchBizMessages($bizId, false);
        ChatMessage::updateRead($bizId);
        return $this->render('index', ['models' => $data]);
    }

    public function actionPoll() {
       $user = \Yii::$app->user;
       if ($user->can('business')) {
           $biz = Business::find()->where(['responsable' => $user->identity->id])->One();
           if ($biz) { 
               $unread = ChatMessage::countUnread($biz->id);
               return json_encode($unread);
           }
       } 
       return json_encode(0);
    }

    public function actionFrom($id) {
        $session = \Yii::$app->session;
        $bizId = $session->get('business');
        $userId = $id;
        $data = ChatMessage::fetchAllMessagesFrom($bizId, $userId);
        return json_encode($data);
    }
}

