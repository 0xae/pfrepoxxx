(function () {
    angular.module('analyticsModule')
    .factory('AnalyticsService', ['$http', '$q', 'AnalyticsCore', 
    function ($http, $q, analyticsCore) {
        var API = './index.php?r=analytics';
        function fetchAnalyticsData(_start, _end) {
            var start = _start.format("YYYY-MM-DD");
            var end = _end.format("YYYY-MM-DD");
            return $http.get(API+"/analytics-data&start="+start+"&end="+end)
                   .then(function (resp){ return resp.data; });
        }

        function processUserGrowth(data, start, end) {
            var userData = analyticsCore.generateTS(
                start, end, data, 'date', 'total_registrations'
            );
            return userData;
        }

        function processInteractionGrowth(data, start, end) {
            var likes = analyticsCore.generateTS(start, end, data, 'date', 'total_likes');
            var comments = analyticsCore.generateTS(start, end, data, 'date', 'total_comments');
            return {
                likes: likes,
                comments: comments
            };
        }

        return {
            fetchAnalyticsData : fetchAnalyticsData,
            processUserGrowth: processUserGrowth,
            processInteractionGrowth: processInteractionGrowth
        }
    }]);
})();


