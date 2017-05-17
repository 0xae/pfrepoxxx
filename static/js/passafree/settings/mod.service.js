(function () {
    angular.module('settingsModule')
    .factory('SettingsService', ['$http', function ($http) {
        var s = {
            hello: function() { console.info('hey there'); }
        };

        return s;
    }]);
})();

