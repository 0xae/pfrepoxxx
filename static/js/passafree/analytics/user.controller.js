(function () {
    angular.module('analyticsModule')
    .controller('UserAnalyticsController', ['AnalyticsService', '$scope',
    function (analyticsService, $scope) {
        function getweek(m) {
            var m1 = moment(m);
            var k = m1.weekday();
            m1.subtract(k, 'day');
            var m2 = moment(m1);
            m2.add(7, 'day');
            return [m1,m2];
        }

        function ThisWeek() {
            var today = moment();
            var w = getweek(today);
            return {
                start: moment(w[0]),
                end: moment(w[1])
            };
        }

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

        var thisWeek = ThisWeek();
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

