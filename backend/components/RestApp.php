<?php
namespace backend\components;
use yii\web\BadRequestHttpException;

class RestApp {
	const queryFilters = array(
		'$eq'  => "=",
		'$neq' => "!=",
		'$li'  => "LIKE",
		'$lt'  => "<",
		'$lte' => "<=",
		'$gt'  => ">",
		'$gte' => ">=",
        '$in' => '_'
	);

    private static function validateOp($op) {
        if (!array_key_exists($op, self::queryFilters)) {
            throw new BadRequestHttpException("Invalid '{$op}' filter clause!");
        }
    }

    public static function parseQueryFilters($ary) {
        $q = [];
        foreach ($ary as $k=>$v) {
            if ($k == 'r') continue;
            $d = explode(':', $v);
            $op = '$eq';
            $val = $d[0];

            if (count($d) == 2) {
                $op = $d[0];
                $val = $d[1];
            } 

            self::validateOp($op);
            if ($op == '$in') {
                $val2 = explode(',', $val);
                if (count($val2) != 2)
                    throw new BadRequestHttpException('$in clause must contain two values separated by commas');
                $q[] = [
                    'field'=>$k,
                    'op' => '>=',
                    'val' => $val2[0]
                ];
                $q[] = [
                    'field'=>$k,
                    'op' => '<=',
                    'val' => $val2[1]
                ];
            } else {
                $q[] = [
                    'field'=>$k,
                    'op' => self::queryFilters[$op],
                    'val' => $val
                ];
            }
        }

        return $q;
    }
}


