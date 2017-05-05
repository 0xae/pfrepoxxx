function updateCounter(counterId, value) {
    $('#'+counterId).text(value);
}

function updateDashboardCounters(data) {
    /*
       var reactions = parseInt(data.reactions.comments) +
       parseInt(data.reactions.likes);
       updateCounter('reactions_counter', reactions);
   */

    updateCounter('user_counter', data.user_count);
    updateCounter('biz_counter', data.business_count);
    updateCounter('producer_counter', data.producer_count);
    updateCounter('events_counter', data.event_count);
    updateCounter('sales_counter', data.passafree_global_revenue+'$00');
}

function updateDashboardGraphs(data) {
    var keys = data.business_data.map(function (d) { return d.business_name; });
    var values = data.business_data.map(function (d) { return parseInt(d.passafree_revenue); });
    LoadBarchart('#revenue_per_business', '', keys, values);

    var keys = data.event_data.map(function (d) { return d.event_name; });
    var values = data.event_data.map(function (d) { return parseInt(d.passafree_revenue); });
    LoadBarchart('#revenue_per_event', '', keys, values);

    var keys = data.producer_data.map(function (d) { return d.producer_name; });
    var values = data.producer_data.map(function (d) { return parseInt(d.passafree_revenue); });
    LoadBarchart('#revenue_per_producer', '', keys, values);
}

function reloadDashboard() {
    var $service = AnalyticsService();
    var $config = {};

    $service.getReports($config)
    .then(function (data) {
        console.info(data);
        updateDashboardCounters(data);
        updateDashboardGraphs(data);
    });
}

$(document).ready(function () {
    reloadDashboard();
});

