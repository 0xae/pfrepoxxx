(function () {
    angular.module('chatModule')
    .controller('ChatController', ['$scope', 'ChatService', function ($scope, chatService) {
        var currentUser = 0;
        function messageTimmingSet(message) {
            var m = message;
            var timming = chatService.prettyDate(m.data);
            m.timming = timming || moment(m.data).format("YYYY-MM-DD");
        }

        $scope.loadMessagesFrom = function (userId, c, isUnread) {
            currentUser = userId;
            $scope.currentUser = userId;
            if (c) { c.is_read = true; }

            chatService.fetchMessagesFrom(userId, isUnread)
            .then(function (data){
                if (data.length == 0) {
                    return;
                }

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
                if ($scope.messages && !c) {
                    $scope.messages = data.concat($scope.messages);
                } else {
                    $scope.messages = data;
                }
            });
        }

        function fetchNewMessages() {
            $scope.loadMessagesFrom(currentUser, null, true);
            chatService.fetchUnread()
            .then(function (data){
                if (data.length) {
                    // new messages
                    var ns = [];
                    _.forEach(data, function (d){
                        messageTimmingSet(d);
                        var found=false;
                        _.forEach($scope.conversations,function (c) {
                            if (c.id_user == d.id_user) {
                                c.is_read = false;
                                c.mensagem = d.mensagem;
                                c.data = d.data;
                                found = true;
                            }
                        });

                        if (!found) {
                            d.is_read = false;
                            ns.push(d);
                        }
                    });

                    $scope.conversations = ns.concat($scope.conversations);
                } 
            });
        }

        setInterval(fetchNewMessages, 3000);
        chatService.fetchConversations()
        .then(function (list) {
            $scope.conversations = list;
            if (list.length) {
                $scope.loadMessagesFrom(list[0].id_user);
            }
        });
    }]);
})();

