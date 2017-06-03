(function () {
    angular.module('settingsModule')
    .controller('SettingsController', ['$scope', function ($scope) {
        $scope.paymentView = 'channels';

        $scope.openModal = function (objid) {
            $.get('./index.php?r=payment-channel/view&id='+objid)
            .then(function (data) {
                // i say i love you..., that's forever
                $("#modal .modal-dialog .modal-content").html(data);
                $("#modal").modal(); 
            });
        }

        $scope.setPaymentView = function (v) {
            $scope.paymentView = v;
        }

        $scope.deleteUser = function (id) {
            confir('Are you sure?');
            $.post('./index.php?r=user/delete&id='+id)
            .then(function (deleted) {
                $('#user_'+id).remove();
            });
        }

        $scope.deletePaymentChannel = function (id) {
            confir('Are you sure?');
            $.post('./index.php?r=payment-channel/delete&id='+id)
            .then(function (deleted) {
                $('#user_'+id).remove();
            });
        }

        $scope.deleteFAQ = function (id) {
            console.info(id);
        }

        function confir(msg) {
            if (!confirm(msg)) 
                throw 'Cancel';
        }
    }]);
})();

