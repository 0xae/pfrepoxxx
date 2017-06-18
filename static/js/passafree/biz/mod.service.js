(function () {
    angular.module('BizModule')
    .factory('BizService', ['$http', '$q', function ($http,$q) {
        var s = {
            hello: function() {
                var defer = $q.defer();
                return defer.promise;
            },
             
            deleteUser : function (userId) {
                return $http.get("./index.php?r=biz-access/delete&id="+userId);
            }
        };

        return s;
    }]);
})();

