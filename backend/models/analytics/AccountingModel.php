<?php
namespace backend\models\analytics;

class AccountingModel {
    public function getAccounting($appUser, $start, $end, $bizId) {
        $s = new RevenueReport;

        $data = [
            'business_revenue' => $s->getRevenuePerBusiness($appUser, $start, $end, $bizId),
            'business_producer_revenue' => $s->getRevenuePerProducer($appUser, $start, $end, '', $bizId)
        ];

        return $data;
    }
}

?>
