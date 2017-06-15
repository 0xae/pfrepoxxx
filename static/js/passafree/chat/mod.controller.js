(function () {
    angular.module('chatModule')
    .controller('ChatController', ['$scope', 'ChatService', function ($scope, chatService) {
        $scope.loadMessagesFrom = function (userId) {
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

                $scope.messages = data;
            });
        }
    }]);
})();
