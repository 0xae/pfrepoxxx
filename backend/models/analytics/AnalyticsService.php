<?php
namespace backend\models\analytics;

class AnalyticsService {
    /**
     * XXX: deal with filters
     * @author ayrton
    */
    public function getGlobalReport($filters) {
        $data = [
            'business_count' => Reports::sql("business")->count()->fetchIt('total_count'),
            'user_count' => Reports::sql("user")->count()->fetchIt('total_count'),
            'producer_count' => (int) Reports::model("bilhete_reports")
                                ->count()
                                ->withFilters($filters)
                                ->groupBy('produtor_id')
                                ->fetchIt('total_count'),
            'event_count' => (int) Reports::model("bilhete_reports")
                                ->count()
                                ->filter('evento_estado','=',1)
                                ->withFilters($filters)
                                ->groupBy('evento_id')
                                ->fetchIt('total_count'),
            'passafree_global_revenue' => Reports::model('bilhete_reports')
                                       ->fields(['t' => 'coalesce(sum(total_passafree_revenue), 0)'])
                                       ->withFilters($filters)
                                       ->fetchIt('t')
        ];

        return $data;
    }

    public function getBusinessReport($filters) {
        $fields = [
            'business_id',
            'business_name',
            'gross_revenue' => 'sum(total_business_gross)',
            'liquid_revenue' => 'sum(total_business_liquid)',
            'passafree_revenue' => 'sum(total_passafree_revenue)'
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('business_id')
                      ->fetch();
    }

    public function getProducerReport($filters) {
        $fields = [
            'producer_id' => 'marca_id',
            'producer_name' => 'marca_nome',
            'gross_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_revenue' => 'sum(total_business_liquid)',
            'passafree_revenue' => 'sum(total_passafree_revenue)'
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('marca_id')
                      ->fetch();
    }

    public function getEventReport($filters) {
        $fields = [
            'event_id' => 'evento_id',
            'event_name' => 'evento_nome',
            'event_date' => 'evento_data',
            'tickets_sold' => 'tickets_sold',
            'raw_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)'
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('evento_id')
                      ->fetch();
    }

    public function getTicketReport($filters) {
        $data = [
        ];
        return $data;
    }
}

