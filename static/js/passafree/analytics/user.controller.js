(function () {
    angular.module('analyticsModule')
    .controller('UserAnalyticsController', ['AnalyticsService', '$scope', 'AnalyticsCore',
    function (analyticsService, $scope, analyticsCore) {
        function loadUserGrowth(_data, start, end) {
            var data = analyticsService.processUserGrowth(_data, start, end);
            var isEmpty = !_.sumBy(data, function (e) { return e[1]; });
            $scope.empty_user_gt = isEmpty;
            LoadTimeseriesChart('user_growth', data);
        }

        function loadInteractionGrowth(_data, start, end) {
            var data = analyticsService.processInteractionGrowth(_data, start, end);
            var totalLikes = _.sumBy(data.likes, function (e) { return e[1]; });
            var totalComments = _.sumBy(data.comments, function (e) { return e[1]; });
            var total = totalLikes + totalComments;

            if (!total) {
                $scope.empty_interaction_gt = true;
            } else {
                $scope.empty_interaction_gt = false;
            }

            LoadTimeseriesChart('interaction_growth', data.likes);
        }

        function loadAnalyticsData(start, end) {
            analyticsService.fetchAnalyticsData(start, end)
            .then(function (data) {
                loadUserGrowth(data.user_statistics.user_growth, start, end);
                loadInteractionGrowth(data.user_statistics.reaction_growth, start, end);
            });
        }

        var period = analyticsCore.getCashoutPeriod();
        loadAnalyticsData(period.start, period.end);

        $('#daterange').daterangepicker({
            "startDate": period.start,
            "endDate": period.end,
            "linkedCalendars": false,
        }, function(start, end, label) {
            loadAnalyticsData(start, end);
        });
    }])
})();

