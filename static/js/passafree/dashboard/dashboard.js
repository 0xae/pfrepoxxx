angular.module('passafree')
.factory('DashboardService', ['$http', '$q', function ($http, $q) {
    function fetchData(start, end) {
        return $http.get(".?r=analytics/dashboard&start="+start+"&end="+end)
               .then(function (resp) {
                   return resp.data;
               });
    }

    return {
        fetchData: fetchData
    };
}])
.controller('DashboardController', 
        ['AnalyticsCore', 'AnalyticsService', 'CoreUtils', 'DashboardService', '$scope',
        function (analyticsCore, analyticsService, coreUtils, dashboardService, $scope) {
            function updateCounter(counterId, value) {
                $('#'+counterId).text(value);
            }

            function updateDashboardCounters(data) {
                updateCounter('user_counter', data.user_count);
                updateCounter('biz_counter', data.business_count);
                updateCounter('producer_counter', data.producer_count);
                updateCounter('events_counter', data.event_count);
                updateCounter('sales_counter', coreUtils.formatMoney(data.total_revenue));
            }

            function updateDashboardGraphs(data) {
                var keys = data.rvn_per_business.map(function (d) { return d.business_name; });
                var values = data.rvn_per_business.map(function (d) { 
                    return parseInt(d.context_revenue);
                });
                LoadBarchart('#revenue_per_business', '', keys, values);

                var keys = data.rvn_per_event.map(function (d) { return d.event_name; });
                var values = data.rvn_per_event.map(function (d) {
                    return parseInt(d.context_revenue);
                });
                LoadBarchart('#revenue_per_event', '', keys, values);

                var keys = data.rvn_per_producer.map(function (d) { return d.producer_name; });
                var values = data.rvn_per_producer.map(function (d) {
                    return parseInt(d.context_revenue);
                });
                LoadBarchart('#revenue_per_producer', '', keys, values);
            }

            var _hash=false;
            var thisWeek = analyticsCore.thisWeek();
            $('#dashboard_datefilter').daterangepicker({
                "startDate": thisWeek.start.format('MM/DD/YYYY'),
                "endDate": thisWeek.end.format('MM/DD/YYYY'),
                "linkedCalendars": false,
            }, function(start, end, label) {
                var conf = {
                    start: start,
                    end: end
                };

                $scope.filters = conf;
                updateDashboard();
            });

            function updateDashboard() {
                var range = analyticsCore.thisWeek();
                if ($scope.filters) {
                    range = $scope.filters;
                }

                var start = range.start.format("YYYY-MM-DD");
                var end = range.end.format("YYYY-MM-DD");

                dashboardService.fetchData(start, end)
                .then(function (data){
                    console.log(data);
                    updateDashboardCounters(data.resume);
                    updateDashboardGraphs(data.revenue);
                });
            }

            updateDashboard();
            // setInterval(updateDashboard, 3000);
        }
]);

