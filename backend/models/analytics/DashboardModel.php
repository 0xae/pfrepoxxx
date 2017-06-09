<?php
namespace backend\models\analytics;

class DashboardModel {
    public function getCounters($appUser, $filters) {
        return $this->_getCounters($appUser, $filters);
    }

    public function getRevenueData($appUser, $filters) {
    }

    private function _getCounters($appUser, $filters) {
        $fis = $filters;
        if ($appUser['role']=='admin' || $appUser['role']=='business') {
            $fis[] = [
                'field' => 'business_id',
                'op' => '=',
                'val' => $appUser['business_id']
            ];
        } else {
            return;
        }

        $data = [
            // admin only
            'business_count' => Reports::sql("business")->count()->fetchIt('total_count'),
            'user_count' => Reports::sql("user")->count()->fetchIt('total_count'),

            // filter
            'producer_count' => (int) Reports::model("producer_report")->count()
                                        ->filter('marca_estado', '=', 1) 
                                        ->withFilters($fis)
                                        ->fetchIt('total_count'),
            // filter
            'event_count' => (int) Reports::model("evento_report")->count()
                                        ->filter('evento_estado','=',1)
                                        ->withFilters($fis)
                                        ->fetchIt('total_count')
        ];

        if ($appUser['role'] == 'admin') {
            $data['total_revenue'] = $this->getPFRevenue($appUser, $filters);
        } else if ($appUser['role'] == 'business') {
            $data['total_revenue'] = $this->getBizRevenue($appUser, $filters);
        }

        return $data;
    }

    private function getPFRevenue($appUser, $filters) {
        return Reports::model('bilhete_reports')
            ->fields(['t' => "round(coalesce(sum(total_business_gross * ((100-business_percent)/100), 0)))"])
            ->withFilters($filters)
            ->fetchIt('t');
    }

    private function getBizRevenue($appUser, $filters) {
        return Reports::model('bilhete_reports')
            ->fields(['t' => "round(coalesce(sum(total_business_gross * (business_percent/100),0)))"])
            ->withFilters($filters)
            ->filter('business_id', '=', $appUser['business_id'])
            ->fetchIt('t');
    }
}

