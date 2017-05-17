(function () {
    angular.module('settingsModule')
    .controller('SettingsController', ['$scope', function ($scope) {
        $scope.openModal = function (objid) {
            $.get('./index.php?r=payment-channel/view&id='+objid)
            .then(function (data) {
                $("#modal .modal-dialog .modal-content").html(data);
                $("#modal").modal(); // i say i love you..., that's forever
            });
        }

        $scope.submitForm = function () {
            console.info("submit the stuff");
        }
    }]);
})();

