<?php
namespace backend\models\analytics;

/**
 * XXX: deal with filters
 * @author ayrton
 */
class AnalyticsService {
    public function getDashboardReport($filters) {
        $data = [
            'business_count' => Reports::sql("business")->count()
                                       ->fetchIt('total_count'),

            'user_count' => Reports::sql("user")->count()
                                   ->fetchIt('total_count'),

            'producer_count' => (int) Reports::model("producer_report")
                                        ->count()
                                        ->filter('marca_estado', '=', 1) 
                                        ->withFilters($filters)
                                        ->fetchIt('total_count'),

            'event_count' => (int) Reports::model("evento_report")
                                        ->count()
                                        ->filter('evento_estado','=',1)
                                        ->withFilters($filters)
                                        ->fetchIt('total_count')
        ];

        return $data;
    }

    public function getProducerRevenue($filters) {
        return Reports::model('bilhete_reports')
                ->fields(['t' => 'coalesce(sum(total_producer_liquid), 0)'])
                ->withFilters($filters)
                ->fetchIt('t');
    }

    public function getProducerAnalytics($filters) {
        $fields = [
            'marca_id',
            'marca_nome',
            'marca_picture',
            'evento_likes' => 'sum(evento_likes)',
            'evento_comments' => 'sum(evento_comments)',
            'total_eventos' => 'count(1)'    
        ];

        return Reports::model('evento_report')
               ->fields($fields)
               ->groupBy('marca_id')
               ->orderBy('total_eventos desc')
               ->withFilters($filters)
               ->fetch();
    }

    public function getBusinessRevenue($filters) {
        return Reports::model('bilhete_reports')
                ->fields(['t' => 'coalesce(sum(total_business_liquid), 0)'])
                ->withFilters($filters)
                ->fetchIt('t');
    }

    public function getPassaFreeRevenue($filters) {
        return Reports::model('bilhete_reports')
                ->fields(['t' => 'coalesce(sum(total_passafree_revenue), 0)'])
                ->withFilters($filters)
                ->fetchIt('t');
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
            'producer_logo' => 'marca_picture',
            'gross_revenue' => 'sum(total_producer_gross)',
            'tickets_sold',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_revenue' => 'sum(total_business_liquid)',
            'business_gross_revenue' => 'sum(total_business_gross)',
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

    public function getUserGrowth($filters) {
        return Reports::model('user_report')
                      ->withFilters($filters)
                      ->fetch();
    }

    public function getReactionGrowth($filters) {
        $fields = [
            'date' => 'evento_data',
            'total_likes' => 'sum(evento_likes)',
            'total_comments' => 'sum(evento_comments)'
        ];

        return Reports::model('evento_report')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('evento_data')
                      ->fetch();
    }


    public function getTicketReport($filters) {
        $data = [];
        return $data;
    }

}

