function updateCounter(counterId, value) {
    $('#'+counterId).text(value);
}

function reloadDashboard() {
    var service = AnalyticsService();
    console.info('updating dashboard...');

    service.getDashboard()
    .then(function (resp) {
        var data = resp.data;
        var reactions = parseInt(data.reactions.comments) +
                        parseInt(data.reactions.likes);
        updateCounter('user_counter', data.user_count);
        updateCounter('biz_counter', data.business_count);
        updateCounter('producer_counter', data.producer_count);
        updateCounter('events_counter', data.events_count);
        updateCounter('sales_counter', data.sales+'$00');
        updateCounter('reactions_counter', reactions);
    });

    service.getEventsPerBusiness()
    .then(function (resp) {
        var data = resp.data;
        var keys = data.map(function (d) { return d.business_name; });
        var values = data.map(function (d) { return parseInt(d.event_count); });

        LoadBarchart('#events_per_business', '', keys, values);
    });

    service.getSalesPerEvent()
    .then(function (resp) {
        var data = resp.data;
        var keys = data.map(function (d) { return d.evento_nome; });
        var values = data.map(function (d) { return parseFloat(d.total_sales); });

        LoadBarchart('#sales_per_event', '', keys, values);
    });

    service.getSalesPerProducer()
    .then(function (resp) {
        var data = resp.data;
        var keys = data.map(function (d) { return d.produtor_nome; });
        var values = data.map(function (d) { return parseFloat(d.total_sales); });

        LoadBarchart('#sales_per_producer', '', keys, values);
    });

    service.getSalesPerBusiness()
    .then(function (resp) {

        var data = resp.data;
        var keys = data.map(function (d) { return d.business_name; });
        var values = data.map(function (d) { return parseFloat(d.total_sales); });

        LoadBarchart('#sales_per_business', '', keys, values);
    });
}

$(document).ready(function () {
    reloadDashboard();
});

