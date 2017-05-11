(function () {
    angular.module('eventModule')
    .factory('EventService', ['$http', function ($http) {
        var s = {
            hello: function() {
                console.info('hey there');
            }
        };

        return s;
    }]);
})();

