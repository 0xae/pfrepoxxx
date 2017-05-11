(function () {
    angular.module('MyModule')
    .factory('MyModuleService', ['$http', function ($http) {
        var s = {
            hello: function() {
                console.info('hey there');
            }
        };

        return s;
    }]);
})();

