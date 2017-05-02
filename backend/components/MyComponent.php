<?php
namespace backend\components;

use Yii;
use yii\base\Component;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\db\Query;

use backend\models\Bilhete;
use backend\models\CompraBilhete;
use backend\models\Evento;
use backend\models\UserHasBilhete;
use backend\models\Utilizador;

class MyComponent extends Component {
    public function welcome() {
        $var = "Hello... Welcome to MyComponent";
        return $var;
    }

    public static function MesExtenco($mes){		 	 
        switch ($mes){		 
        case 1: return $mes = "Jan"; break;
        case 2: return $mes = "Feb"; break;
        case 3: return $mes = "Mar"; break;
        case 4: return $mes = "Apr"; break;
        case 5: return $mes = "May"; break;
        case 6: return $mes = "Jun"; break;
        case 7: return $mes = "Jul"; break;
        case 8: return $mes = "Aug"; break;
        case 9: return $mes = "Sep"; break;
        case 10: return $mes = "Oct"; break;
        case 11: return $mes = "Nov"; break;
        case 12: return $mes = "Dec"; break;
        }
    }

    public static  function MesExtencoNome($mes){		 	 
        switch ($mes){		 
        case 1: return $mes = "Janeiro"; break;
        case 2: return $mes = "Fevereiro"; break;
        case 3: return $mes = "Março"; break;
        case 4: return $mes = "Abril"; break;
        case 5: return $mes = "Maio"; break;
        case 6: return $mes = "Junho"; break;
        case 7: return $mes = "Julho"; break;
        case 8: return $mes = "Augosto"; break;
        case 9: return $mes = "Setembro"; break;
        case 10: return $mes = "Outubro"; break;
        case 11: return $mes = "Novembro"; break;
        case 12: return $mes = "Dezembro"; break;
        }
    }

    public static  function Totalfaturado($idevento){		 	 

        $modelBilhete =  Bilhete::find()->where(['estado' => 1, 'evento_idevento'=>$idevento])->all();
        $subt=$total=0;


        foreach ($modelBilhete as $key => $bi) {
            $subt = $bi->preco * $bi->comprado; 
            $total = $total + $subt;
        }

        return $modelBilhete ? $total : 0;
    }

    public static function Anversario($idevento){

        $com=Yii::$app->db->createCommand("select distinct u.data_nascimento,u.nome,u.apelido,u.foto,u.email,u.sexo,
            u.idutilizador from utilizador u, bilhete b, compra_bilhete c where c.utilizador_idutilizador =u.idutilizador 
            and b.evento_idevento=$idevento and c.bilhete_idbilhete=b.idbilhete  and b.estado=1")->queryAll();

        $modelEvento= Evento::find()->where(['estado'=>1,'idevento'=>$idevento])->one();
        $anivers=[];

        if($modelEvento && $com){
            foreach ($com as $con){

                if(date('d',strtotime($con['data_nascimento']))==date('d',strtotime($modelEvento->data)) &&
                    date('m',strtotime($con['data_nascimento']))==date('m',strtotime($modelEvento->data))) {


                    $anivers[] = ['idutilizador' => $con['idutilizador'], 'email' => $con['email'],
                        'data_nascimento' => $con['data_nascimento'], 'nome' => $con['nome'],
                        'apelido' => $con['apelido'], 'foto' => $con['foto']];
                }

            }

        }
        return $anivers;


    }

    public static  function getQuantidadeBilhete($idutilizador,$idevento){

        $comp=CompraBilhete::find()
            ->join('INNER JOIN','bilhete','bilhete.idbilhete=bilhete_idbilhete')
            ->where(['utilizador_idutilizador'=>$idutilizador,'bilhete.evento_idevento'=>$idevento,'bilhete.estado'=>1]);


        return $comp->count()?$comp->count():0;


    }

    public static  function existUtilizador($idevento){


        $comp=CompraBilhete::find()
            ->join('INNER JOIN','bilhete','bilhete.idbilhete=bilhete_idbilhete')
            ->where(['bilhete.evento_idevento'=>$idevento,'bilhete.estado'=>1]);


        return $comp->all()?true:false;

    }

    public static  function geralstocktotal($idevento){

        $com=Yii::$app->db->createCommand("select DISTINCT(b.nome_bilhete), SUM(b.stock) 
            from bilhete b where b.evento_idevento=$idevento")
            ->queryAll();

        return $com?false:$com;

    }


    public static function PercentagemPorBilheteEntrada($idbilhete){
        $countPert=0;

        try{
            $count=0;
            $bilhetecomp=CompraBilhete::find()->where(['bilhete_idbilhete'=>$idbilhete])->all();
            if($bilhetecomp){
                foreach ($bilhetecomp as $com){

                    $entrada=UserHasBilhete::find()->where(['idcompra_bilhete'=>$com->idcompra_bilhete]);
                    $count+=$entrada->count();

                }

                $bilhete=Bilhete::find()->where(['idbilhete'=>$idbilhete])->one();
                $countPert=($count*100)/$bilhete->comprado;

            }


        }
        catch (ErrorException $excep){


            return 0;
        }

        return round($countPert);


    }

    public static function PercentagemPorBilheteStock($idbilhete){

        $bilhete=Bilhete::find()->where(['idbilhete'=>$idbilhete,'estado'=>1])->one();

        try{
            if($bilhete){
                $valor=100-(($bilhete->comprado*100)/$bilhete->stock);
            }
            else{
                return 100;
            }
        }catch (ErrorException $excep){

            return 100;
        }

        return $valor>0?round($valor):100;

    }

    public static  function getNomeBilhete($idcomprado){

        try{
            $com=CompraBilhete::find()->where(['idcompra_bilhete'=>$idcomprado])->one();

            $bilhet=Bilhete::find()->where(['idbilhete'=>$com->bilhete_idbilhete])->one();
            if($bilhet)
                return $bilhet->nome_bilhete;
            else return "";
        }
        catch (ErrorException $ex){
            return '';


        }

    }

    public static function bilheteValidado ($idcomprado){
        return UserHasBilhete::find()->where(['idcompra_bilhete'=>$idcomprado])->exists();
    }


    public static function getNomeUser($iduser) {
        $user=Utilizador::findOne(['idutilizador'=>$iduser]);
        if($user){
            return $users=['nome'=>$user->nome,'foto'=>$user->foto];
        }
        else
            return $users=['nome'=>'','foto'=>''];
    }


    public function verificarEventoActivado($id) {
        $bilhetess=Bilhete::find()->where(['evento_idevento'=>$id])->all();
        $activo=false;

        if($bilhetess){
            foreach($bilhetess as $bilhete){
                if($bilhete->estado==1)
                    $activo=true;

                else return false;
            }
        }

        if($activo)
            return true;
        else
            return false;
    }

}

?>
