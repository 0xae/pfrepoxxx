<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "tipoevento".
 *
 * @property string $idtipoevento
 * @property string $nome
 * @property string $descricao
 * @property integer $estado
 */
class Dashboard {
    public function adminDashboard() {
        $biz = $this->queryOne("select count(1) as t from business;", []);
        $prod = $this->queryOne("select count(1) as t from produtor;", []);
        $events = $this->queryOne("select count(1) as t from evento;", []);
        $users = $this->queryOne("select count(1) as t from user;", []);

        $comments = $this->queryOne("select count(1) as t from comentario", []);
        $likes = $this->queryOne("select count(1) as t from gosto", []);
        $query = " select coalesce(sum(preco),0) as t from compra_bilhete CB
                    JOIN bilhete B on B.idbilhete = CB.bilhete_idbilhete
                    where month(dataCompra) = month(now()) ";
        $sales = $this->queryOne($query, []);

        return [
            "business_count" => (int) $biz['t'],
            "producer_count" => (int) $prod['t'],
            "events_count" => (int) $events['t'],
            "user_count" => (int) $users['t'],
            "reaction_counts" => ((int)$comments['t']) + ((int)$likes['t']),
            "ticket_sales" => (int)$sales['t']
        ];
    }

    public function businessDashboard($businessId) {
    }

    public function countBusiness() {
        $biz = $this->queryOne("select count(1) as t from business;", []);
        return (int) $biz['t'];
    }

    public function countProducers($businessId) {
        $filter = 'where business_id=:biz';
        if ($businessId=='ALL') $filter='';
    }


    private function queryAll($sql, $filter) {
        return $this->prepareCommand($sql, $filter)
                    ->queryAll();
    }

    private function queryOne($sql, $filter) {
        return $this->prepareCommand($sql, $filter)
                    ->queryOne();
    }

    private function prepareCommand($sql, $filter) {
        $filters = [];
        foreach ($filter as $k=>$v) {
            $filters[":$k"] = $v;
        }

        $conn = Yii::$app->getDb();
        return $conn->createCommand($sql, $filters);
    }
}

