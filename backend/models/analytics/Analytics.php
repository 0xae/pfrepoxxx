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
class Analytics {
    private $query;
   
    private function __construct($sql) {
        $this->query = (new Query())
                ->select(['*'])
                ->from(['f' => "($sql)"])
                ->where('true');
    }

    public static function fromSQL($sql) {
        $i = new Analytics($sql);
        return $i;
    }

    public static function fromFile($file) {
        $rawSQL = self::load($file);
        return new Analytics($rawSQL);
    }

    public function fields($f) {
        $this->query->select($f);
        return $this;
    }

    public function addFields($f) {
        $this->query->addSelect($f);
        return $this;
    }

    public function groupBy($f) {
        $this->query->groupBy($f);
        return $this;
    }

    public function filter($col, $op, $val) {
        $this->query->andWhere([$op, $col, $val]);
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
    */

    /**
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

