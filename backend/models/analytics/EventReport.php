<?php
namespace backend\models\analytics;

class EventReport {
    public function getCount($appUser, $filters) {
        $count = Reports::model("evento_report")
            ->count()
            ->filter('evento_estado','=',1)
            ->withFilters($filters)
            ->fetchIt('total_count');
        return (int) $count;
    }

    public function getReportById($appUser, $id) {
        $filters = [['field'=>'evento_id', 'op'=>'=', 'val'=>$id]];
        $data = $this->getEventReport($appUser, $filters);
        if (!empty($data)) {
            $data = $data[0];
        }
        return $data;
    }

    public function getReportByFilters($appUser, $filters) {
        return $this->getEventReport($appUser, $filters);
    }

    private function getEventReport($appUser, $filters) {
        $fields = [
            'event_id' => 'evento_id',
            'event_name' => 'evento_nome',
            'event_date' => 'evento_data',
            'tickets_stock' => 'sum(tickets_current_stock)',
            'tickets_sold' => 'sum(tickets_sold)',
            'tickets_total' => 'sum(coalesce(bilhete_stock,0))',
            'tickets_percent' => 'round(
                                   coalesce( (sum(tickets_sold)*100) / sum(bilhete_stock), 0)
                                 )',
            'checkin_total' => 'evento_checkin',
            'checkin_percent' => 'round(
                                    coalesce( (evento_checkin*100) / sum(tickets_sold), 0)
                                  )',
            'raw_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_revenue' => 'sum(total_business_liquid)',
            'passafree_revenue' => 'sum(total_passafree_revenue)'
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('evento_id')
                      ->fetch();
    }
}

