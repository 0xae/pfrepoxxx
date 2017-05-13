(function () {
    angular.module('analyticsModule')
    .factory('AnalyticsService', ['$http', '$q', 'AnalyticsCore', 
    function ($http, $q, analyticsCore) {
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
            return '&' + buf.join('&');
        }

        function format(date) {
            return date.format('YYYY-MM-DD');
        }

        function _get(endp, filters) {
            var filtersf = _process(filters);
            endp = endp || '';
            return $http.get(API+endp+filtersf);
        }

        return {
            getUserGrowth : function (filters) {
                var defer = $q.defer();
                var conf = {
                    date: {
                        $in: format(filters.start)+ ',' +
                            format(filters.end)
                    }
                };

                _get('/user-growth', conf)
                .then(function (resp) {
                    var data = resp.data.data;
                    var userData = analyticsCore.generateTS(
                        filters.start,
                        filters.end,
                        data,
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
                var conf = {
                    evento_data: {
                        $in: format(filters.start) + ',' +
                            format(filters.end)
                    }
                };

                _get('/interaction-growth', conf)
                .then(function (resp) {
                    var data = resp.data.data;
                    var likes = analyticsCore.generateTS(filters.start, filters.end, data, 'date', 'total_likes');
                    var comments = analyticsCore.generateTS(filters.start, filters.end, data, 'date', 'total_comments');

                    defer.resolve({
                        likes: likes,
                        comments: comments
                    });
                }, function (error) {
                    defer.reject(error);
                });

                return defer.promise;
            },

            getProducerAnalytics: function (filters) {
                var defer = $q.defer();

                _get('/producer-analytics', filters)
                .then(function (resp) {
                    var data = resp.data;
                    defer.resolve(data);
                }, function (error) {
                    defer.reject(error);
                });

                return defer.promise;
            },

            dateFormat: format
        }
    }]);
})();

