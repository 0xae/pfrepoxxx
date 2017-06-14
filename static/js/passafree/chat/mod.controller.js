(function () {
    angular.module('chatModule')
    .controller('ChatController', ['ChatService', function (chatService) {
        chatService.hello();
    }]);
})();
