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
            'ticket_stock' => 'tickets_current_stock',
            'ticket_biz_percent' => 'business_bilhete_percent',

            'tickets_sold' => 'sum(tickets_sold)',
            'tickets_total' => 'sum(coalesce(bilhete_stock,0))',
            'tickets_percent' => 'round(
                                   coalesce( (sum(tickets_sold)/bilhete_stock) * 100, 0)
                                 )',
            'checkin_total' => 'evento_checkin',
            'checkin_percent' => 'round(
                                    coalesce(
                                        ((select sum(1) from user_has_bilhete
                                            where idcompra_bilhete in 
                                            (select idcompra_bilhete from compra_bilhete
                                                    where bilhete_idbilhete = bilhete_id
                                            )
                                        )/sum(tickets_sold)) * 100
                                        ,0
                                    )
                                 )',
            'raw_revenue' => 'sum(total_producer_gross)',
            'liquid_revenue' => 'sum(total_producer_liquid)',
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('bilhete_id')
                      ->fetch();
    }
}

