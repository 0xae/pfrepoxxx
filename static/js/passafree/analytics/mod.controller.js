(function () {
    angular.module('analyticsModule')
    .controller('UserAnalyticsController', ['AnalyticsService', '$scope',
    function (analyticsService) {
        var config = {
        };

        analyticsService.getUserGrowth(config)
        .then(function (data) {
            LoadTimeseriesChart('user_growth', data);
        });

        analyticsService.getInteraction(config)
        .then(function (data) {
            LoadTimeseriesChart('interaction_growth', data.likes);
        });
    }])

    .controller('ProducerAnalyticsController', ['AnalyticsService', function (analyticsService) {
    }]);
})();

