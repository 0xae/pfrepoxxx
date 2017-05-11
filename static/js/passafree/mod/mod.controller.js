(function () {
    angular.module('MyModule')
    .controller('MyModuleController', ['MyModuleService', function (MyModuleService) {
        MyModuleService.hello();
    }]);
})();

