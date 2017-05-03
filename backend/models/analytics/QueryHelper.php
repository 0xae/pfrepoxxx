<?php
namespace backend\models\analytics;

use Yii;
use yii\base\Exception;

class QueryFinder {
	const queryFilters = array(
		'$eq'  => "=",
		'$neq' => "!=",
		'$li'  => "LIKE",
		'$lt'  => "<",
		'$lte' => "<=",
		'$gt'  => ">",
		'$gte' => ">=",
        '$in' => 'IN'
	);

    public static function findObjects($model, $queryParams, $queryFilters) {
        $fields = self::getFilters($queryFilters);
        $filters = [];
        $bindValues = [];

        foreach($fields as $column => $values) {
            $op = $values[0];
            $value = $values[1];

            if ($op == self::queryFilters['$in']) {
                $filters[] = "$column $op ($value)";
            } else {
                $bindValues[":$column"] = $value;
                $filters[] = "$column $op :$column";
            }
        }

        $rawquery = self::getModel($model);
        $query = self::format($rawquery, $queryParams);
        $params = implode(' AND ', $filters);

        $cmd = Yii::app()->db->createCommand()
            ->select('*')
            ->from("($query)f") 
            ->where($params, $bindValues);

        return $cmd->queryAll(); 
    }

    private static function getModel($modelName) {
        $fullPath = 'backend' 
                    . DIRECTORY_SEPARATOR 
                    . 'data'
                    . DIRECTORY_SEPARATOR 
                    . $modelName . '.sql'; 
        $query = file_get_contents($fullPath);
        return $query;
    }

	private static function getFilters($filterBean) {
        if(!isset($filterBean['fields']) || empty($filterBean['fields']) || 
            !is_array($filterBean['fields'])) {
            return [];
		}
		
		$fields = [];
		foreach($filterBean['fields'] as $column=>$filterClause) {
			if (empty($filterClause) || !is_array($filterClause)) {
				throw new CHttpException(400, 'Malformed filter clause!');
			}
			$filterType = array_keys($filterClause)[0];

			if (!array_key_exists($filterType, self::queryFilters)) {
				$repr = print_r($filterType, true);
				throw new CHttpException(400, "Invalid '{$repr}' filter clause!");
			}
			
			$value = $filterClause[$filterType];
			$filterType = self::queryFilters[$filterType]; // we're ready
			if (array_key_exists($column, $fields)) {
				throw new CHttpException(400, "Duplicate '{$column}' filter clause!");
			}
			$fields[$column] = [$filterType, $value];
		}

		return $fields;
	}

    private static function format($str, $vars) {
        if (!$str) 
            return '';

        if (count($vars) > 0) {
            foreach ($vars as $k => $v) {
                $str = str_replace('{'.$k.'}', $v, $str);
            }
        }

        return $str;
    }

    private static function findObjectsByQuery($filterBean, $model) {
        $fields = self::getFilters($filterBean);
        $filters = [];
        $bindValues = [];

        foreach($fields as $column => $values) {
            $op = $values[0];
            $value = $values[1];
            $bindValues[":$column"] = $value;
            $filters[] = "$column $op :$column";
        }

        $params = implode(" AND ", $filters);
        $query = Yii::app()->db->createCommand()
            ->select('*')
            ->from($model) 
            ->where($params, $bindValues);

        return $query->queryAll(); 
    }
}

