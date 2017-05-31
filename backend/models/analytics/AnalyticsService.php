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

    public function getProducerAnalytics($filters, $mods=false) {
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

    public function getBusinessRevenue($bizId, $filters) {
        return Reports::model('bilhete_reports')
            ->fields(['t' => 'coalesce(
                                sum(total_business_gross) * (business_percent/100),
                                 0
                              )'])
                ->withFilters($filters)
                ->filter('business_id', '=', $bizId)
                ->fetchIt('t');
    }

    public function getPassaFreeRevenue($filters) {
        return Reports::model('bilhete_reports')
            ->fields(['t' => 'coalesce(
                                sum(total_business_gross) * ((100-business_percent)/100),
                                 0
                              )'])
            ->withFilters($filters)
            ->fetchIt('t');
    }

    public function getBusinessReport($filters) {
        $fields = [
            'business_id',
            'business_name',
            'gross_revenue' => 'sum(total_business_gross)',
            'liquid_revenue' => 'sum(total_business_gross) * (business_percent/100)',
            'passafree_revenue' => 'sum(total_business_gross) * ((100-business_percent)/100)'
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('business_id')
                      ->fetch();
    }

    public function getProducerReport($filters, $mods=false) {
        $fields = [
            'producer_id' => 'marca_id',
            'producer_name' => 'marca_nome',
            'producer_logo' => 'marca_picture',
            'gross_revenue' => 'sum(total_producer_gross)',
            'tickets_sold',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_revenue' => 'sum(total_business_gross) * (business_percent/100)',
            'business_gross_revenue' => 'sum(total_business_gross)',
            'passafree_revenue' => 'sum(total_business_gross) * ((100-business_percent)/100)'
        ];

        $q =  Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('marca_id');

        if ($mods) {
            if (isset($mods['order_by'])) {
                $q->orderBy($mods['order_by']);
            }
        }

        return $q->fetch();
    }

    public function getEventReport($filters) {
        $fields = [
            'event_id' => 'evento_id',
            'event_name' => 'evento_nome',
            'event_date' => 'evento_data',
            'tickets_sold' => 'sum(tickets_sold)',
            'tickets_total' => 'sum(bilhete_stock)',
            'raw_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_revenue' => 'sum(total_business_gross) * (business_percent/100)',
            'passafree_revenue' => 'sum(total_business_gross) * ((100-business_percent)/100)'
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
}

