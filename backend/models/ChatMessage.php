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

    public static function fetchBizMessages($bizId) {
        $sql = "
            select distinct id_user,
                   concat(u.nome, ' ', u.apelido) as nome, 
                   u.foto, u.email, mensagem,
                   data,
                   is_read
            from utilizador_app_mensagem 
            join utilizador u on u.idutilizador = id_user
            where idBusiness = :bizId
            group by id_user order by data desc
        ";

        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(':bizId', $bizId);
        $_data = $cmd->queryAll();

        $data = [];
        foreach ($_data as $obj) {
            $data[] = [
                'nome' => $obj['nome'],
                'foto' => $obj['foto'],
                'mensagem' => $obj['mensagem'],
                'data' => $obj['data'],
                'is_read' => $obj['is_read'],
                'id_user' => $obj['id_user'],
            ];
        }

        return $data;
    }

    public static function fetchAllMessagesFrom($bizId, $userId) {
        $sql = "
            select  id_user,concat(u.nome, ' ', u.apelido) as nome, 
                    u.foto, u.email, u.data_nascimento, 
                    u.telefone, u.sexo,
                    mensagem, data, is_read
            from utilizador_app_mensagem 
            join utilizador u on u.idutilizador = id_user
            where idBusiness = :bizId and id_user = :userId
            order by data desc
        ";

        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindParam(':bizId', $bizId);
        $cmd->bindParam(':userId', $userId);
        $_data = $cmd->queryAll();
        $data = [];
        foreach ($_data as $obj) {
            $data[] = [
                'nome' => $obj['nome'],
                'foto' => $obj['foto'],
                'mensagem' => $obj['mensagem'],
                'data' => $obj['data'],
                'is_read' => $obj['is_read'],
                'data_nascimento' => $obj['data_nascimento'],
                'telefone' => $obj['telefone'],
                'email' => $obj['email'],
                'id_user' => $obj['id_user'],
                'sexo' => $obj['sexo']
            ];
        }

        return $data;
    }

    public static function findModel($id) {
        if (($model = ChatMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 }

