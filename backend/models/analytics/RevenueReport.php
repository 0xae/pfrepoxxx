<?php
namespace backend\models\analytics;

use yii;
use yii\db\QueryBuilder;
use yii\web\BadRequestHttpException;

/**
 * XXX: deal with filters
 * @author ayrton
 */
class RevenueReport {
    public function getRevenuePerBusiness($appUser, $start, $end, $bizId=''){
        $this->notNull([$start, $end]);
        $fields = [
            'business_id',
            'business_name',
            'gross_revenue' => 'round(sum(total_business_gross))',
            'liquid_revenue' => 'round(sum(total_business_gross) * (business_percent/100))',
            'passafree_revenue' => 'round(sum(total_business_gross) * ((100-business_percent)/100))'
        ];

        if ($appUser['role'] == 'admin') {
            $fields['context_revenue'] = $fields['passafree_revenue'];
        } else if ($appUser['role'] == 'business') {
            $fields['context_revenue'] = $fields['liquid_revenue'];
        }

        return Reports::model('bilhete_reports')
                      ->fields($fields)
                      ->params([':start'=>$start, ':end'=>$end])
                      ->filter('business_id', '=', $bizId)
                      ->groupBy('business_id')
                      ->fetch();
    }

    public function getRevenuePerEvent($appUser, $start, $end, $eventId='') {
        $this->notNull([$start, $end]);
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
                      ->filter('evento_id', '=', $eventId)
                      ->groupBy('evento_id')
                      ->fetch();
    }

    public function getRevenuePerProducer($appUser, $start, $end, $producerId='', $bizId=''){
        $this->notNull([$start, $end]);
        $fields = [
            'producer_id' => 'marca_id',
            'producer_name' => 'marca_nome',
            'producer_logo' => 'marca_picture',
            'gross_revenue' => 'sum(total_producer_gross)',
            'tickets_sold',
            'liquid_revenue' => 'sum(total_producer_liquid)',
            'business_gross_revenue' => 'sum(total_business_gross)',
            'business_revenue' => 'round(sum(total_business_gross) * (business_percent/100))',
            'passafree_revenue' => 'round(sum(total_business_gross) * ((100-business_percent)/100))'
        ];

        if ($appUser['role'] == 'admin') {
            $fields['context_revenue'] = $fields['passafree_revenue'];
        } else if ($appUser['role'] == 'business') {
            $fields['context_revenue'] = $fields['business_revenue'];
        }

        return  Reports::model('bilhete_reports')
                  ->fields($fields)
                  ->params([':start'=>$start, ':end'=>$end])
                  ->filter('marca_id', '=', $producerId)
                  ->filter('business_id', '=', $bizId)
                  ->groupBy('marca_id')
                  ->fetch();
    }

    public function getRevenuePerTicket($appUser, $start, $end, $eventId) {
        $this->notNull([$start, $end]);
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
                      ->params([':start'=>$start, ':end'=>$end])
                      ->filter('evento_id', '=', $eventId)
                      ->groupBy('bilhete_id')
                      ->fetch();
    }

    public function getPFRevenue($appUser, $start, $end) {
        $this->notNull([$start, $end]);
        $ret= Reports::model('bilhete_reports')
            ->fields(['t' => "round(coalesce(".
                                "sum(total_business_gross) * ((100-business_percent)/100), 0".
                            "))",
           ])
            ->params([':start'=>$start, ':end'=>$end]);

        # $dbg = new QueryBuilder(Yii::$app->db);
        # $sql = $dbg->build($ret->query);
        # var_dump($sql);
        # die;

        return $ret->fetchIt('t');
    }

    public function getBizRevenue($appUser, $start, $end, $bizId='') {
        $this->notNull([$start, $end]);
        return Reports::model('bilhete_reports')
            ->fields(['t' => "round(coalesce(sum(total_business_gross) * (business_percent/100),0))"])
            ->params([':start'=>$start, ':end'=>$end])
            ->filter('business_id', '=', $bizId)
            ->fetchIt('t');
    }

    private function notNull($ary) {
        foreach($ary as $k=>$v) {
            if ($v == NULL) {
                throw new BadRequestHttpException("null param received.");
            }
        }
    }
}

