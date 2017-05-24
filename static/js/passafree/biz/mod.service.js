(function () {
    angular.module('BizModule')
    .factory('BizService', ['$http', function ($http) {
        var s = {
            hello: function() {
                var defer = $q.defer();
                return defer.promise;
            }
        };

        return s;
    }]);
})();

