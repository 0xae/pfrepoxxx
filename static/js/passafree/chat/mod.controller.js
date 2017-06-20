(function () {
    angular.module('chatModule')
    .controller('ChatController', ['$scope', 'ChatService', function ($scope, chatService) {
        var currentUser = 0;
        function messageTimmingSet(message) {
            var m = message;
            var timming = chatService.prettyDate(m.data);
            m.timming = timming || moment(m.data).format("YYYY-MM-DD");
        }

        $scope.loadMessagesFrom = function (userId, c) {
            currentUser = userId;
            c.is_read = true;
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
                return;
            }

            chatService.fetchUnreadFrom(currentUser)
            .then(function (data){
                if (data.length) {
                    data.forEach(messageTimmingSet);
                    $scope.messages = data.concat($scope.messages);
                    var topMessage = data[0];
                    $scope.conversations.forEach(function (c) {
                        if (c.id_user == currentUser) {
                            c.is_read = false;
                            c.mensagem = topMessage.mensagem;
                            c.data = topMessage.data;
                        }
                    });
                } 
            });
        }

        setInterval(fetchNewMessages, 3000);

        chatService.fetchConversations()
        .then(function (list) {
            $scope.conversations = list;
        });
    }]);
})();

