<?php
namespace backend\models\analytics;

/**
 * XXX: deal with filters
 * @author ayrton
 */
class AnalyticsService {
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

}

