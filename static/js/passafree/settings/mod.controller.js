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

        $scope.deleteBizRule = function (id) {
            confir('This will deleted permanently.Are you sure?');
            $.post('./index.php?r=rule/delete&id='+id)
            .then(function (deleted) {
                $('#biz_'+id).remove();
            });
        }

        $scope.deleteEventType = function (id) {
            confir('Are you sure?');
            $.post('./index.php?r=tipoevento/delete&id='+id)
            .then(function (deleted) {
                $('#evt_'+id).remove();
            });
        }

        $scope.deleteCountry = function (id) {
            confir('Are you sure?');
            $.post('./index.php?r=country/delete&id='+id)
            .then(function (deleted) {
                $('#ct_'+id).remove();
            });
        }

        $scope.deleteFAQ = function (id) {
            confir('This will deleted permanently.Are you sure?');
            $.post('./index.php?r=faq/delete&id='+id)
            .then(function (deleted) {
                $('#faq_'+id).remove();
            });
        }

        function confir(msg) {
            if (!confirm(msg)) 
                throw 'Cancel';
        }
    }]);
})();

