function updateCounter(counterId, value) {
    $('#'+counterId).text(value);
}

function updateDashboardCounters(config, data) {
    /*
       var reactions = parseInt(data.reactions.comments) +
       parseInt(data.reactions.likes);
       updateCounter('reactions_counter', reactions);
   */

    updateCounter('user_counter', data.user_count);
    updateCounter('biz_counter', data.business_count);
    updateCounter('producer_counter', data.producer_count);
    updateCounter('events_counter', data.event_count);

    if (config.context == 'business') {
        updateCounter('sales_counter', data.business_data[0].liquid_revenue+'$00');
    } else if (config.context == 'producer') {
        updateCounter('sales_counter', data.producer_data[0].liquid_revenue+'$00');
    } else if (config.context == 'passafree') {
        updateCounter('sales_counter', data.passafree_global_revenue+'$00');
    }
}

function updateDashboardGraphs(config, data) {
    var keys = data.business_data.map(function (d) { return d.business_name; });
    var values = data.business_data.map(function (d) { 
        return parseInt(d[config.context_graph_col]);
    });
    LoadBarchart('#revenue_per_business', '', keys, values);

    var keys = data.event_data.map(function (d) { return d.event_name; });
    var values = data.event_data.map(function (d) {
        return parseInt(d.liquid_revenue);
    });
    LoadBarchart('#revenue_per_event', '', keys, values);

    var keys = data.producer_data.map(function (d) { return d.producer_name; });
    var values = data.producer_data.map(function (d) {
        return parseInt(d[config.context_graph_col]);
    });
    LoadBarchart('#revenue_per_producer', '', keys, values);
}

function getConfig() {
    var d = {
        context: $("#dashboard_context").attr('data-value'),
        filters: {}
    };
    d.context_graph_col = d.context+'_revenue';
    return d;
}

function reloadDashboard() {
    var $service = AnalyticsService();
    var config = getConfig();

    $service.getReports(config.filters)
    .then(function (data) {
        updateDashboardCounters(config, data);
        updateDashboardGraphs(config, data);
    });
}

$(document).ready(function () {
    reloadDashboard();
});

