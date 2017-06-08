(function () {
angular.module('coreModule', [])
    
.directive('noData', function () {
    return {
        restrict: "E",
        template:'<center>'+
                '    <div class="" style="height: 100px;">'+
                '        <span class="" style="padding: 15px; padding-bottom: 16px; padding-left: 28px; height: 100px; background: url(static/img/analytics.png) 0px -68px no-repeat; "></span>'+
                '        <h3>No data for that period.</h3>'+
                '    </div>'+
                '</center>',
        link: function (scope, element, attrs) {
            console.log("inited ");
        }
    }
})

})();

