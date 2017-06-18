(function () {
    angular.module('BizModule')
    .factory('BizService', ['$http', '$q', function ($http,$q) {
        var s = {
            hello: function() {
                var defer = $q.defer();
                return defer.promise;
            }
        };

        return s;
    }]);
})();

