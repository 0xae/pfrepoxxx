(function () {
    angular.module('BizModule')
    .controller('BizController', ['BizService', '$scope', function (BizService, $scope) {
        BizService.hello();

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
                    var json = (response);
                    console.info(json);
                } 
            });
        }
    }]);
})();

