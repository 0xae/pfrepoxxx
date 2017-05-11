(function () {
    angular.module('eventModule')
    .controller('EventController', ['EventService', function (EventService) {
        EventService.hello();
    }]);
})();

