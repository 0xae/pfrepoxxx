(function () {
    angular.module('analyticsModule')
    .controller('UserAnalyticsController', ['AnalyticsService', '$scope',
    function (analyticsService, $scope) {
        var userConfig = {};

        analyticsService.getUserGrowth(userConfig)
        .then(function (data) {
            LoadTimeseriesChart('user_growth', data);
        });

        analyticsService.getInteraction(userConfig)
        .then(function (data) {
            LoadTimeseriesChart('interaction_growth', data.likes);
        });

        $scope.hello = function (e) {
            console.info('hello');
            e.stopPropagation();
        }
    }])

    .controller('ProducerAnalyticsController', ['AnalyticsService', '$scope', function (analyticsService, $scope) {
        var producerConfig = {};

        analyticsService.getProducerAnalytics(producerConfig)
        .then(function (data) {
            loadMostPopularG(data.data.eventsPerProducer);
            loadTopSellersG(data.data.ticketsPerProducer);
            loadMostProfitableG(data.data.ticketsPerProducer);
        });

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
    }]);
})();

