(function () {
    angular.module('chatModule')
    .controller('ChatController', ['$scope', 'ChatService', function ($scope, chatService) {
        var currentUser = 0;
        function messageTimmingSet(message) {
            var m = message;
            var timming = chatService.prettyDate(m.data);
            m.timming = timming || moment(m.data).format("YYYY-MM-DD");
        }

        $scope.loadMessagesFrom = function (userId) {
            currentUser = userId;
            chatService.fetchMessagesFrom(userId)
            .then(function (data){
                $scope.profile = {
                    nome: data[0].nome,
                    email: data[0].email,
                    data_nascimento: data[0].data_nascimento,
                    sexo: data[0].sexo,
                    telefone: data[0].telefone,
                    foto: data[0].foto,
                    id: data[0].id_user,
                };

                data.forEach(messageTimmingSet);
                $scope.messages = data;
            });
        }

        function fetchNewMessages() {
            if (!currentUser) {
                console.info("no current-user");
                return;
            }

            chatService.fetchUnreadFrom(currentUser)
            .then(function (data){
                if (data.length) {
                    data.forEach(messageTimmingSet);
                    $scope.messages = data.concat($scope.messages);
                } else {
                    console.info("no messages from " + $scope.profile.nome);
                }
            });
        }

        var tickId = setInterval(fetchNewMessages, 3000);
    }]);
})();
