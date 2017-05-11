(function () {
    angular.module('userModule')
    .controller('UserController', ['UserService','$scope', function (userService, $scope) {
        function updateMessageCounter() {
            userService.countNewMessages()
            .then(function (data) {
                var count = parseInt(data);
                if (count > 0) {
                    $scope.newMessages = count;
                }
            });
        }

        updateMessageCounter();
        var $tid = setInterval(updateMessageCounter, 3000);
    }]);
})();

