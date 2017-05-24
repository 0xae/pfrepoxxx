<?php
namespace backend\models\analytics;

class TicketReport {
    /**
     * TODO: date filters
     */
    public function getReportOfEvent($appUser, $eventId) {
        $filters = [[
            'field'=>'evento_id',
            'op'=>'=',
            'val'=>$eventId
        ]];

        $fields = [
            'ticket_id' => 'bilhete_id' ,
            'ticket_name' => 'bilhete_nome',
            'ticket_description' => 'bilhete_descricao',
            'ticket_preco' => 'bilhete_preco',
            'ticket_stock' => 'sum(tickets_current_stock)',
            'ticket_biz_percent' => 'business_bilhete_percent',

            'tickets_sold' => 'sum(tickets_sold)',
            'tickets_total' => 'sum(bilhete_stock)',
            'tickets_percent' => 'floor(
                                   coalesce( (sum(tickets_sold)*100) / sum(bilhete_stock), 0)
                                 )',
            'checkin_total' => 'total_checkin',
            'checkin_percent' => 'floor(
                                    coalesce( (total_checkin*100) / sum(tickets_sold), 0)
                                  )',
            'raw_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            /* 
             * unecessary for now
             * 'business_revenue' => 'sum(total_business_liquid)',
             * 'passafree_revenue' => 'sum(total_passafree_revenue)' 
             */
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('bilhete_id')
                      ->fetch();
    }
}

