(function () {
    angular.module('userModule')
    .factory('UserService', ['$http', '$q', function ($http, $q) {
        var CHAT_API = './index.php?r=chat';
        var s = {
            countNewMessages: function() {
                var defer = $q.defer();
                $http.get(CHAT_API+'/poll')
                .then(function (resp) {
                    defer.resolve(resp.data);
                }, function (error) {
                    defer.reject(error);
                });
                return defer.promise;
            }
        };

        return s;
    }]);
})();

