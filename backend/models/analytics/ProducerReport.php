<?php
namespace backend\models\analytics;

class ProducerReport {
    public function getCount($appUser, $filters) {
           $producer = Reports::model("producer_report")
                    ->count()
                    ->filter('marca_estado', '=', 1) 
                    ->withFilters($filters)
                    ->fetchIt('total_count');
           return (int) $producer;
    }

    public function getProducerRevenue($appUser, $filters) {
        return Reports::model('bilhete_reports')
                ->fields(['t' => 'coalesce(sum(total_producer_liquid), 0)'])
                ->withFilters($filters)
                ->fetchIt('t');
    }

    public function getProducerAnalytics($appUser, $filters, $mods=false) {
        $fields = [
            'marca_id',
            'marca_nome',
            'marca_picture',
            'evento_likes' => 'sum(evento_likes)',
            'evento_comments' => 'sum(evento_comments)',
            'total_eventos' => 'count(1)'    
        ];

        $q = Reports::model('evento_report')
               ->fields($fields)
               ->groupBy('marca_id')
               ->withFilters($filters);

        if ($mods) {
            if (isset($mods['order_by'])) {
                $q->orderBy($mods['order_by']);
            }
        }
        
        return $q->fetch();
    }
}

