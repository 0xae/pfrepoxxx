(function () {
    angular.module('BizModule')
    .controller('BizController', ['BizService', '$scope', function (bizService, $scope) {
        $scope.mappings = [];
        $scope.submitForm = function () {
            var form = $("form#permission_form");
            // return false if form still have some validation errors
            if (form.find('.has-error').length) {
                return false;
            }

            // submit form
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response) {
                    var json = JSON.parse(response);
                    $scope.mappings.push(json);
                    $scope.$apply();
                } 
            });
        }

        $scope.deleteUser = function (userId, idx) {
            console.info("deleteng ", userId);
            if (!confirm("Este utilizador sera eliminado permanentemente. Deseja continuar?"))
                return;
            bizService.deleteUser(userId)
            .then(function (resp){
                if (idx) {
                    $scope.mappings.splice(idx, 1); 
                    console.log("mappings ", $scope.mappings);
                } else {
                    $("#mapping_"+userId).remove();
                }
            });
        }
    }]);
})();

