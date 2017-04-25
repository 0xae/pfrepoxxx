<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "business".
 *
 */
class Reports {
    public function getBusinessReport($filter) {
        $sql = $this->load('business_report');
        $resume = $this->queryOne("
                    select sum(passafree_total) as passafree_total,
                           sum(business_total) as business_total
                    from ($sql) K; ", 
                    $filter
                );
        $data= $this->queryAll($sql, $filter);
        return [
            "data" => $data,
            "resume" => $resume
        ];
    }

    public function getProducerReport($filter) {
        $sql = $this->load('producer_report');
        return [
            "data" => $this->queryAll($sql, $filter),
            "resume" => []
        ];
    }

    public function getEventsReport($filter) {
        $sql = $this->load('evento_report');
        return [
            "data" => $this->queryAll($sql, $filter),
            "resume" => []
        ];
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

    private function load($file) {
        return file_get_contents("../data/{$file}.sql");
    }
}
