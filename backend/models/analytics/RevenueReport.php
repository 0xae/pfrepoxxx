<?php
namespace backend\models\analytics;

/**
 * XXX: deal with filters
 * @author ayrton
 */
class RevenueReport {
    const PASSAFREE_REVENUE = "";
    const BIZ_REVENUE = "";

    public function getRevenuePerBusiness($appUser){
        $fields = [
            'business_id',
            'business_name',
            'gross_revenue' => 'round(sum(total_business_gross))',
            'liquid_revenue' => 'round(sum(total_business_gross) * (business_percent/100))',
            'passafree_revenue' => 'round(sum(total_business_gross) * ((100-business_percent)/100))'
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('business_id')
                      ->fetch();
    }

    public function getRevenuePerEvent($appUser) {
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
            'business_revenue' => 'sum(total_business_gross) * (business_percent/100)',
            'passafree_revenue' => 'sum(total_business_gross) * ((100-business_percent)/100)'
        ];

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->withFilters($filters)
                      ->groupBy('evento_id')
                      ->fetch();
    }

    public function getRevenuePerProducer($appUser){
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

    public function getRevenuePerTicket($appUser, $eventId) {
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
                      ->filter('evento_id', '=', $eventId)
                      ->groupBy('bilhete_id')
                      ->fetch();
    }

    public function getPFRevenue($appUser, $filters) {
        return Reports::model('bilhete_reports')
            ->fields(['t' => "round(coalesce(sum(total_business_gross * ((100-business_percent)/100), 0)))"])
            ->withFilters($filters)
            ->fetchIt('t');
    }

    public function getBizRevenue($appUser, $filters) {
        return Reports::model('bilhete_reports')
            ->fields(['t' => "round(coalesce(sum(total_business_gross * (business_percent/100),0)))"])
            ->withFilters($filters)
            ->filter('business_id', '=', $appUser['business_id'])
            ->fetchIt('t');
    }
}

