(function () {
    angular.module('analyticsModule')
    .controller('UserAnalyticsController', ['AnalyticsService', '$scope', 'AnalyticsCore',
    function (analyticsService, $scope, analyticsCore) {
        function loadUserGrowth(c) {
            analyticsService.getUserGrowth(c)
            .then(function (data) {
                LoadTimeseriesChart('user_growth', data);
            });
        }

        function loadInteractionGrowth(c) {
            analyticsService.getInteraction(c)
            .then(function (data) {
                LoadTimeseriesChart('interaction_growth', data.likes);
            });
        }

        var thisWeek = analyticsCore.thisWeek();
        loadUserGrowth(thisWeek);
        loadInteractionGrowth(thisWeek);

        $('#daterange').daterangepicker({
            "startDate": thisWeek.start.format('MM/DD/YYYY'),
            "endDate": thisWeek.end.format('MM/DD/YYYY'),
            "linkedCalendars": false,
        }, function(start, end, label) {
            var conf = {start: start, end: end};
            loadUserGrowth(conf);
            loadInteractionGrowth(conf);
        });
    }])
})();

