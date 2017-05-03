<?php
namespace backend\models\analytics;

class ReportsService {
    public function dashboardReports($filters) {
        $data = [];
        $biz = Reports::sql("business")->count()->fetch();
        $prod = Reports::sql("produtor")->count()->fetch();
        $events = Reports::sql("evento")->count()->filter('estado','=',1)->fetch();
        $users = Reports::sql("user")->count()->fetch();
        $sales = Reports::model('bilhete_reports')
                 ->fields(['total_sales' => 'coalesce(sum(total_venda), 0)'])
                 ->filter('data_compra', '=', 'current_date()')
                 ->fetch();

        $reactions = [
            'likes' => Reports::sql('gosto')->count()->fetch()[0]['total_count'],
            'comments' => Reports::sql('comentario')->count()->fetch()[0]['total_count']
        ];

        return [
            'data' => [
                'business_count' => $biz[0]['total_count'],
                'producer_count' => $prod[0]['total_count'],
                'events_count' => $events[0]['total_count'],
                'user_count' => $users[0]['total_count'],
                'sales' => $sales[0]['total_sales'],
                'reactions' => $reactions
            ]
        ];
    }
}


