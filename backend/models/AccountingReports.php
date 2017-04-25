<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "business".
 *
 */
class AccountingReports {
    public function getTicketReport($filter) {
        $sqlSource = $this->load('bilhete_reports');
        $sql = "select * from ($sqlSource) K 
                where business_id = :business ";

        $data = $this->queryAll($sql, $filter);
        return $this->makeResponse($data, []);
    }

    public function getBusinessRevenue($filter) {
        $sqlSource = $this->load('business_report');
        $sql = "select * from ($sqlSource) K 
                where business_id = :business ";

        $data = $this->queryOne($sql, $filter);
        $data = !$data ? [] : $data;
        return $this->makeResponse($data, []);
    }

    public function getTopProducers($filter) {
        $producerSql = $this->load('producer_report');
        $sql = "select * from ($producerSql) K 
                where business_id = :business
                order by total_venda desc
                limit 10";
        $resume = [];
        return $this->makeResponse($this->queryAll($sql, $filter), $resume);
    }

    public function getTopEvents($filter) {
        $sourceSql = $this->load('evento_report');
        $sql = "select * from ($sourceSql) K 
                where business_id = :business
                order by total_venda,data desc
                limit 10";
        $resume = [];
        return $this->makeResponse($this->queryAll($sql, $filter), $resume);
    }

    public function getAllBusiness($filter) {
        $sql = $this->load('business_report');
        $resume = $this->queryOne("
                    select sum(passafree_total) as passafree_total,
                           sum(business_total) as business_total
                    from ($sql) K; ", 
                    $filter
                );
        return $this->makeResponse($this->queryAll($sql, $filter), $resume);
    }

    public function getAllProducer($filter) {
        $sql = $this->load('producer_report');
        return $this->makeResponse($this->queryAll($sql, $filter), []);
    }

    public function getAllEvents($filter) {
        $sql = $this->load('evento_report');
        return $this->makeResponse($this->queryAll($sql, $filter), []);
    }

    /**
     * Here lies implementation details
     * the code is written to be as short
     * as possible and thus avoiding bugs ;)
     * beware of insanity!!!
     *
    */
    private function queryAll($sql, $filter) {
        return $this->prepareCommand($sql, $filter)
                    ->queryAll();
    }

    private function queryOne($sql, $filter) {
        return $this->prepareCommand($sql, $filter)
                    ->queryOne();
    }

    private function makeResponse($data, $resume) {
        return [
            "data" => $data,
            "resume" => $resume
        ];
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
