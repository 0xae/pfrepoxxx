<?php
namespace backend\controllers;
use backend\models\UploadForm;
use backend\models\analytics\Analytics;

class ComponentController extends \yii\web\Controller {
    public function actionIndex() {
    }

    public function actionData() {
        $start = @$_GET['start'];
        $end   = @$_GET['end'];

        $data = Analytics::fromFile('bilhete_reports')
                ->fields(['evento'=>'evento_nome', 'total_profit' =>  'sum(total_venda)'])
                ->groupBy(['idevento'])
                ->fetch();

        echo json_encode($data);
    }
}
