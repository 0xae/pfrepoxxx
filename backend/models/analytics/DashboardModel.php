<?php
namespace backend\models\analytics;

class DashboardModel {
    public function getRevenueData($appUser, $start, $end) {
        $this->notNull([$start, $end]);
        $r = new RevenueReport;

        return [
            "rvn_per_business" => $r->getRevenuePerBusiness($appUser, $start, $end),
            "rvn_per_event" => $r->getRevenuePerEvent($appUser, $start, $end),
            "rvn_per_producer" => $r->getRevenuePerProducer($appUser, $start, $end)
        ];
    }

    public function getResume($appUser, $start, $end) {
        $this->notNull([$start, $end]);
        return $this->_getAggregates($appUser, $start, $end);
    }

    private function _getAggregates($appUser, $start, $end) {
        $s = new RevenueReport();
        $totalRevenue = 0;
        $bizId = -1;

        if ($appUser['role']=='admin') {
            $bizId = '';
            $totalRevenue = $s->getPFRevenue($appUser, $start, $end);
        } else if ($appUser['role'] == 'business') {
            $bizId = $appUser['business_id'];
            $totalRevenue = $s->getBizRevenue($appUser, $start, $end, $bizId);
        } 

        $eventStart = date("Y-m-01", strtotime($start));
        $eventEnd = date("Y-m-t", strtotime($end));

        $data = [
            // admin only
            'business_count' => (int) Reports::sql("business")->count()->fetchIt('total_count'),
            'user_count' => (int) Reports::sql("user")->count()->fetchIt('total_count'),

            // filter
            'producer_count' => (int) Reports::model("producer_report")->count()
                                        ->filter('business_id', '=', $bizId)
                                        ->filter('marca_estado', '=', 1) 
                                        ->fetchIt('total_count'),
            // filter
            'event_count' => (int) Reports::model("evento_report")->count()
                                        ->filter('business_id', '=', $bizId)
                                        ->filter('evento_estado', '=', 1)
                                        ->filter('evento_data', '>=', $eventStart)
                                        ->filter('evento_data', '<=', $eventEnd)
                                        ->fetchIt('total_count'),

            // 'total_revenue' => (int) $totalRevenue,
            'total_revenue' => (int) $totalRevenue
        ];

        return $data;
    }

    private function notNull($ary) {
        foreach($ary as $k=>$v) {
            if ($v == NULL) {
                throw new BadRequestHttpException("null param received.");
            }
        }
    }
}

