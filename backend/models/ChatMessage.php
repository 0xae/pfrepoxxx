<?php
namespace backend\models;
use Yii;

/**
 * This is the model class for table "utilizador_app_mensagem".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $mensagem
 * @property string $data
 */
 class ChatMessage extends \yii\db\ActiveRecord {
     /**
      * @inheritdoc
      */
     public static function tableName() { 
         return 'utilizador_app_mensagem';
     }

     /**
      * @inheritdoc
      */
      public function rules() {
          return [
              [['id_user', 'mensagem'], 'required'],
              [['id_user'], 'integer'],
              [['mensagem'], 'string'],
              [['data'], 'safe']
          ];
      }

     /**
      * @inheritdoc
      */
     public function attributeLabels(){ 
         return [
             'id' => 'ID',
             'id_user' => 'Id User',
             'mensagem' => 'Mensagem',
             'data' => 'Data',
         ];
     }

    /**
     * Finds the ChatMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChatMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id) {
        if (($model = ChatMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function countUnread($businessId) {
        $sql = '
            select count(distinct id_user) as total_unread from utilizador_app_mensagem
            where is_read=false and idbusiness=:business
        ';
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(':business', $businessId);
        $data = $cmd->queryOne();
        return (int)$data['total_unread'];
    }

    public static function updateRead($businessId) {
        $sql = 'update utilizador_app_mensagem set is_read=true where idBusiness=:business';
        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(':business', $businessId);
        $cmd->execute();
    }

    public function getUser() {
        return Utilizador::find()
                ->where(['idutilizador' => $this->id_user])
                ->one();
    }
 }

