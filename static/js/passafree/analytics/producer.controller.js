(function () {
    angular.module('analyticsModule')
    .controller('ProducerAnalyticsController', ['AnalyticsService', 'AnalyticsCore', '$scope', 
    function (analyticsService, analyticsCore, $scope) {

        function loadData(config) {
            analyticsService.getProducerAnalytics(config)
            .then(function (data) {
                loadMostPopularG(data.data.eventsPerProducer);
                loadTopSellersG(data.data.ticketsPerProducer);
                loadMostProfitableG(data.data.ticketsPerProducer);
            });
        }

        function loadMostPopularG(data) {
            var ks = data.map(function (d) { return d.marca_nome });
            var vs = data.map(function (d) { return parseInt(d.evento_likes) + parseInt(d.evento_comments); });
            var total = _.sumBy(vs, function (e) { return e; });
            if (!total) {
                $scope.no_populars_data = true;
            } else {
                $scope.no_populars_data = false;
            }
            LoadBarchart('#most_popular', '', ks, vs);
        }

        function loadTopSellersG(data) {
            var ks = data.map(function (d) { return d.producer_name; });
            var vs = data.map(function (d) { return parseInt(d.tickets_sold); });
            var total = _.sumBy(vs, function (e) { return e; });
            if (!total) {
                $scope.no_sellers_data = true;
            } else {
                $scope.no_sellers_data = false;
            }
            LoadBarchart('#top_sellers', '', ks, vs);
        }

        function loadMostProfitableG(data) {
            var ks = data.map(function (d) { return d.producer_name; });
            var vs = data.map(function (d) { return parseInt(d.relative_revenue); });
            var total = _.sumBy(vs, function (e) { return e; });
            if (!total) {
                $scope.no_profit_data = true;
            } else {
                $scope.no_profit_data = false;
            }
            LoadBarchart('#most_profitable', '', ks, vs);
        }

        var thisWeek = analyticsCore.thisWeek();
        loadData(thisWeek);
        $('#producer_daterange').daterangepicker({
            "startDate": thisWeek.start.format('MM/DD/YYYY'),
            "endDate": thisWeek.end.format('MM/DD/YYYY'),
            "linkedCalendars": false,
        }, function(start, end, label) {
            var conf = {start: start, end: end};
            console.info(conf);
            loadData(conf);
        });
    }]);
})();

