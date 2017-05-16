angular.module('passafree')
.controller('DashboardController', ['AnalyticsCore', 'AnalyticsService', 
        function (analyticsCore, analyticsService) {
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
                updateCounter('sales_counter', formatMoney(data.global_revenue));
            }

            function updateDashboardGraphs(config, data) {
                var keys = data.business_data.map(function (d) { return d.business_name; });
                var values = data.business_data.map(function (d) { 
                    return parseInt(d[config.context_graph_col]);
                });
                LoadBarchart('#revenue_per_business', '', keys, values);

                var keys = data.event_data.map(function (d) { return d.event_name; });
                var values = data.event_data.map(function (d) {
                    // return parseInt(d.liquid_revenue);
                    return parseInt(d[config.context_graph_col]);
                });
                LoadBarchart('#revenue_per_event', '', keys, values);

                var keys = data.producer_data.map(function (d) { return d.producer_name; });
                var values = data.producer_data.map(function (d) {
                    return parseInt(d[config.context_graph_col]);
                });
                LoadBarchart('#revenue_per_producer', '', keys, values);
            }

            var filters = {
            };

            function getConfig() {
                var context = $("#dashboard_context").attr('data-value');
                var d = {
                    context: context,
                    filters: filters,
                    context_graph_col: context+'_revenue'
                };
                return d;
            }

            var _hash=false;
            function reloadDashboard() {
                var $service = AnalyticsService();
                var config = getConfig();

                $service.getReports(config.filters)
                .then(function (data) {
                    if (!_hash || JSON.stringify(data) != _hash) {
                        _hash = JSON.stringify(data);
                        updateDashboardCounters(config, data);
                        updateDashboardGraphs(config, data);
                    }
                });
            }

            reloadDashboard();
            setInterval(reloadDashboard, 3000);

            var thisWeek = analyticsCore.thisWeek();
            $('#dashboard_datefilter').daterangepicker({
                "startDate": thisWeek.start.format('MM/DD/YYYY'),
                "endDate": thisWeek.end.format('MM/DD/YYYY'),
                "linkedCalendars": false,
            }, function(start, end, label) {
                var conf = {start: start, end: end};
                filters = conf;
                reloadDashboard();
            });
        }
])

function formatMoney(num) {
    return Number(num).toLocaleString('en');
}
