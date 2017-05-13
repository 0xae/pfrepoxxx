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
            LoadBarchart('#most_popular', '', ks, vs);
        }

        function loadTopSellersG(data) {
            var ks = data.map(function (d) { return d.producer_name; });
            var vs = data.map(function (d) { return parseInt(d.tickets_sold); });
            LoadBarchart('#top_sellers', '', ks, vs);
        }

        function loadMostProfitableG(data) {
            var ks = data.map(function (d) { return d.producer_name; });
            var vs = data.map(function (d) { return parseInt(d.relative_revenue); });
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
            loadData(conf);
        });
    }]);
})();

