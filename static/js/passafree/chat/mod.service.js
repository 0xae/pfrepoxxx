(function () {
    angular.module('chatModule')
    .factory('ChatService', ['$http', function ($http) {
        var s = {
            fetchMessagesFrom: function(bizId, userId) { 
            }
        };

        return s;
    }]);
})();

