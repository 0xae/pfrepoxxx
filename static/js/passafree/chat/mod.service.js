(function () {
    angular.module('chatModule')
    .factory('ChatService', ['$http', function ($http) {
        var API = "./index.php?r=chat/from&id=";
        var s = {
            fetchMessagesFrom: function(userId) { 
                return $http.get(API+userId).then(function (resp){ return resp.data; });
            }
        };

        return s;
    }]);
})();

