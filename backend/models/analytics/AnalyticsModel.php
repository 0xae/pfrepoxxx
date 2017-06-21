<?php
namespace backend\models\analytics;

class AnalyticsModel {
    public function getUserStatistics($appUser, $start, $end, $countryId, $bizId) {
        $data = [
            'user_growth' => $this->getUserGrowth($start, $end, $countryId),
            'reaction_growth' => $this->getReactionGrowth($start, $end, $bizId),
        ];
        return $data;
    }

    public function getProducerStatistics($appUser, $start, $end, $bizId) {
        $s = new RevenueReport;
        $data = [
            'most_popular' => $this->getProducerReaction($start, $end, $bizId),
            'top_seller' => $this->getProducerTopSales($start, $end, $bizId),
            'revenue_growth' => $this->getRevenueGrowth($start, $end, $bizId),
            'producer_growth' => $this->getProducerGrowth($start, $end, $bizId),
            'events_growth' => $this->getEventsGrowth($start, $end, $bizId),
            'most_profitable' => $this->getProducerTopProfitable($appUser, $start, $end, $bizId)
        ];
        return $data;
    }

    private function getProducerTopProfitable($appUser, $start, $end, $bizId) {
        $fields = [
            'producer_id' => 'marca_id',
            'producer_name' => 'marca_nome',
            'producer_picture' => 'marca_picture',
            'gross_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_revenue' => 'round(sum(total_business_gross) * (business_percent/100))',
            'passafree_revenue' => 'round(sum(total_business_gross) * ((100-business_percent)/100))'
        ];

        if ($appUser['role'] == 'admin') {
            $fields['context_revenue'] = $fields['passafree_revenue'];
        } else if ($appUser['role'] == 'business') {
            $fields['context_revenue'] = $fields['business_revenue'];
        }

        return Reports::model('bilhete_reports')
              ->fields($fields)
              ->params([':start'=>$start, ':end'=>$end])
              ->filter('business_id', '=', $bizId)
              ->orderBy("{$fields['passafree_revenue']} desc")
              ->groupBy('marca_id')
              ->fetch();
    }

    private function getProducerTopSales($start, $end, $bizId) {
        $fields = [
            'producer_id' => 'marca_id',
            'producer_name' => 'marca_nome',
            'producer_picture' => 'marca_picture',
            'gross_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_revenue' => 'round(sum(total_business_gross) * (business_percent/100))',
            'passafree_revenue' => 'round(sum(total_business_gross) * ((100-business_percent)/100))',
            'tickets_sold' => 'sum(tickets_sold)',
            'tickets_price_average' => 'avg(bilhete_preco)',
        ];

        return Reports::model('bilhete_reports')
              ->fields($fields)
              ->params([':start'=>$start, ':end'=>$end])
              ->filter('business_id', '=', $bizId)
              ->orderBy("{$fields['gross_revenue']} desc")
              ->groupBy('marca_id')
              ->fetch();
    }

    private function getProducerReaction($start, $end, $bizId) {
        $fields = [
            'marca_id',
            'marca_nome',
            'marca_picture',
            'evento_likes' => 'sum(evento_likes)',
            'evento_comments' => 'sum(evento_comments)',
            'total_reaction'  => 'sum(evento_likes)+sum(evento_comments)',
            'total_eventos' => 'count(1)'    
        ];

        return Reports::model('evento_report')
               ->fields($fields)
               ->filter('business_id', '=', $bizId)
               ->filter('evento_data', '>=', $start)
               ->filter('evento_data', '<=', $end)
               ->groupBy('marca_id')
               ->orderBy("({$fields['total_reaction']}) desc")
               ->fetch();
    }

    private function getUserGrowth($start, $end, $countryId='') {
        return Reports::model('user_report')
                      ->fields(['date', 'total_registrations'])                        
                      ->filter('date', '>=', $start)
                      ->filter('date', '<=', $end)
                      ->filter('country_id', '=', $countryId)
                      ->fetch();
    }

    private function getReactionGrowth($start, $end, $bizId) {
        $fields = [
            'date' => 'evento_data',
            'total_likes' => 'sum(evento_likes)',
            'total_comments' => 'sum(evento_comments)'
        ];

        return Reports::model('evento_report')
                      ->fields($fields)
                      ->filter('evento_data', '>=', $start)
                      ->filter('evento_data', '<=', $end)
                      ->filter('business_id', '=', $bizId)
                      ->groupBy('evento_data')
                      ->fetch();
    }

    private function getRevenueGrowth($start, $end, $bizId) {
        $fields = [
            'period',
            'business_revenue' => 'round(sum(total_business_gross) * (business_percent/100))'
        ];
        return  Reports::model('bilhete_reports')
                  ->fields($fields)
                  ->params([':start'=>$start, ':end'=>$end])
                  ->filter('business_id', '=', $bizId)
                  ->groupBy('period')
                  ->fetch();
    }

    private function getProducerGrowth($start, $end, $bizId) {
        $fields = [
            'period',
            'total_producers' => 'count(1)'
        ];

        return Reports::model("producer_report")
                       ->fields($fields)
                       ->filter('created_at', '>=', $start)
                       ->filter('created_at', '<=', $end)
                       ->filter('business_id', '=', $bizId)
                       ->filter('marca_estado', '=', 1) 
                       ->groupBy('period')
                       ->fetch();
    }

    private function getEventsGrowth($start, $end, $bizId) {
        $fields = [
            'period',
            'total_events' => 'count(1)'
        ];

        return Reports::model("evento_report")
                ->fields($fields)
                ->filter('business_id', '=', $bizId)
                ->filter('evento_estado', '=', 1)
                ->filter('evento_data', '>=', $start)
                ->filter('evento_data', '<=', $end)
                ->groupBy('period')
                ->fetch();
    }
}
