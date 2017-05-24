(function () {
    angular.module('BizModule')
    .controller('BizController', ['BizService', function (BizService) {
        BizService.hello();
    }]);
})();

