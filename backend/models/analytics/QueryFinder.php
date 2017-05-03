<?php
namespace backend\models\analytics;

use Yii;
use yii\base\Exception;
use yii\db\Query;

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


    public function findObjects($model, $queryParams, $queryFilters) {
        $query = $this->getModel($model);
        $cmd = (new Query())
                ->select(['*'])
                ->from(['f' => "($query)"]);

        return $cmd->all(); 
    }

    private function getModel($modelName) {
        $fullPath = 'backend' 
                    . DIRECTORY_SEPARATOR 
                    . 'data'
                    . DIRECTORY_SEPARATOR 
                    . $modelName . '.sql'; 
        $query = file_get_contents($fullPath);
        return $query;
    }
}

