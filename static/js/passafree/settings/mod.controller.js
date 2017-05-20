(function () {
    angular.module('settingsModule')
    .controller('SettingsController', ['$scope', function ($scope) {
        $scope.paymentView = 'cards';
        $scope.openModal = function (objid) {
            $.get('./index.php?r=payment-channel/view&id='+objid)
            .then(function (data) {
                // i say i love you..., that's forever
                $("#modal .modal-dialog .modal-content").html(data);
                $("#modal").modal(); 
            });
        }

        $scope.submitForm = function () {
            console.info("submit the stuff");
        }

        $scope.setPaymentView = function (v) {
            console.info(v);
            $scope.paymentView = v;
        }
    }]);
})();

