<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\ChatMessage;
use backend\models\Business;

class ChatController extends Controller {
    public function behaviors() {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'poll', 'from', 'unread-from'],
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
        $data = ChatMessage::fetchBizMessages($bizId, false);

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
        ChatMessage::updateRead($bizId, $userId);

        return json_encode($data);
    }

    /**
     * TODO: use a filter for arrays instead of this
     *       imperative aproach
    */
    public function actionUnreadFrom($id) {
        $session = \Yii::$app->session;
        $bizId = $session->get('business');
        $userId = $id;
        $data = ChatMessage::fetchAllMessagesFrom($bizId, $userId);

        $filters = [];
        foreach ($data as $k=>$v) {
            if ($v['is_read'] == '0') {
                $filters[] = $v;
            }
        }

        if (!empty($filters)) {
            ChatMessage::updateRead($bizId, $userId);
        }

        return json_encode($filters);
    }
}
