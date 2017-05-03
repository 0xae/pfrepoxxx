<?php
namespace backend\models\analytics;

use Yii;
use yii\base\Exception;
use yii\db\Query;

/**
 * The unified analytics system v1
 * @author ayrton
 * @date 2017-05-03 00:53
 */
class Reports {
    private $query;
   
    private function __construct($sql) {
        $this->query = (new Query())
                ->select(['*'])
                ->from($sql)
                ->where('true');
    }

    public static function sql($sql) {
        $i = new Reports($sql);
        return $i;
    }

    public static function model($file) {
        $rawSQL = self::load($file);
        $sql = ['f' => "($rawSQL)"];
        return new Reports($sql);
    }

    public function fields($f) {
        $this->query->select($f);
        return $this;
    }

    public function count() {
        $this->query->select(['total_count' => 'count(1)']);
        return $this;
    }

    public function addFields($f) {
        $this->query->addSelect($f);
        return $this;
    }

    public function filter($col, $op, $val) {
        $this->query->andFilterWhere([$op, $col, $val]);
        return $this;
    }

    public function groupBy($f) {
        $this->query->groupBy($f);
        return $this;
    }

    public function fetch() {
        return $this->query->all();
    }

    /**
     * Here lies implementation details
     * the code is written to be as short
     * as possible and thus avoiding bugs ;)
     * beware of insanity!!!
     * XXX: check this dir thing
    */
    private static function load($file) {
        $sql = file_get_contents("backend/data/{$file}.sql");
        if ($sql == '') {
            throw new Exception("Invalid analytics file: $file!");
        }
        return $sql;
    }
}

