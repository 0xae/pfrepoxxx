(function () {
    angular.module('analyticsModule')
    .factory('AnalyticsService', ['$http', '$q', function ($http, $q) {
        var API = './index.php?r=analytics';

        function _parse(pr) {
            return pr.then(function (d) {
                return JSON.parse(d);
            }); 
        }

        function _process(filters) {
            var fkeys = Object.keys(filters);
            var buf = [];
            fkeys.forEach(function (f) { 
                var fval = filters[f];          
                if ($.isPlainObject(fval)) {
                    var k=Object.keys(fval)[0];
                    var ffval = fval[k]; 
                    buf.push(f+'='+k+':'+ffval);
                } else {
                    buf.push(f+'='+fval);
                }
            });
            return buf.join('&');
        }

        function _get(endp, filters) {
            var filtersf = _process(filters);
            endp = endp || '';
            return $http.get(API+endp+filtersf);
        }

        function parseTimestamp(date) {
            var m=moment(date);
            var year=parseInt(m.format("YYYY"));
            var month=parseInt(m.format("M"));
            var day=parseInt(m.format("D"));
            return Date.UTC(year, month, day);
        }

        function parseTimeseries(data, dateCol, countCol){
            var objs = data.map(function (d) {
                var time = parseTimestamp(d[dateCol]);
                return [time, parseInt(d[countCol])];
            });

            return [objs];
        }

        return {
            getUserGrowth : function (filters) {
                var defer = $q.defer();

                _get('/user', filters)
                .then(function (resp) {
                    var data = resp.data.data;
                    var userData = parseTimeseries(data,
                                        'date',
                                        'total_registrations'
                                    );
                    defer.resolve(userData);
                }, function (error) {
                    defer.reject(error);
                });

                return defer.promise;
            },

            getInteraction: function (filters) {
                var defer = $q.defer();

                _get('/reactions', filters)
                .then(function (resp) {
                    var data = resp.data.data;
                    var likes = parseTimeseries(data, 'date', 'total_likes');
                    var comments = parseTimeseries(data, 'date', 'total_comments');

                    defer.resolve({
                        likes: likes,
                        comments: comments
                    });
                }, function (error) {
                    defer.reject(error);
                });

                return defer.promise;
            }
        }
    }]);
})();

