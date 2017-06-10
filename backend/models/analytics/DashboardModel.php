<?php
namespace backend\models\analytics;

class DashboardModel {
    public function getRevenueData($appUser, $start, $end) {
        $r = new RevenueReport;

        return [
            "rvn_per_business" => $r->getRevenuePerBusiness($appUser, $start, $end),
            "rvn_per_event" => $r->getRevenuePerEvent($appUser, $start, $end),
            "rvn_per_producer" => $r->getRevenuePerProducer($appUser, $start, $end)
        ];
    }

    public function getCounters($appUser, $start, $end) {
        return $this->_getAggregates($appUser, $start, $end);
    }

    private function _getAggregates($appUser, $start, $end) {
        $s = new RevenueReport();
        $bizId = -1;
        $totalRevenue = 0;

        if ($appUser['role']=='admin') {
            $bizId = '';
            $totalRevenue = $s->getPFRevenue($appUser, $start, $end);
        } else if ($appUser['role'] == 'business') {
            $bizId = $appUser['business_id'];
            $totalRevenue = $s->getBizRevenue($appUser, $start, $end, $bizId);
        } 

        $data = [
            // admin only
            'business_count' => Reports::sql("business")->count()->fetchIt('total_count'),
            'user_count' => Reports::sql("user")->count()->fetchIt('total_count'),

            // filter
            'producer_count' => (int) Reports::model("producer_report")->count()
                                        ->filter('business_id', '=', $bizId)
                                        ->filter('marca_estado', '=', 1) 
                                        ->fetchIt('total_count'),
            // filter
            'event_count' => (int) Reports::model("evento_report")->count()
                                        ->filter('business_id', '=', $bizId)
                                        ->filter('evento_estado', '=', 1)
                                        ->filter('evento_data', '>=', $start)
                                        ->filter('evento_data', '<=', $end)
                                        ->fetchIt('total_count'),

            // 'total_revenue' => (int) $totalRevenue,
            'total_revenue' => $totalRevenue
        ];

        return $data;
    }
}

