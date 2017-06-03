<?php
namespace backend\controllers;
use backend\models\UploadForm;
use backend\models\analytics\ReportsService;

class ComponentController extends \yii\web\Controller {
    private $service = new ReportsService();
    public function actionIndex() {
    }

    public function actionData() {
        $start = @$_GET['start'];
        $end = @$_GET['end'];

        $data = Reports::model('bilhete_reports')
                ->fields(['evento'=>'evento_nome', 'total_profit' =>  'sum(total_venda)'])
                ->filter('data_compra', '>', $start)
                ->filter('data_compra', '<', $end)
                ->groupBy(['idevento'])
                ->fetch();

        echo json_encode($data);
    }
}
