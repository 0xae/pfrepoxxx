(function () {
    angular.module('chatModule')
    .factory('ChatService', ['$http', function ($http) {
        function prettyDate(time){
            d = new Date();
            var date = new Date((time || "").replace(/-/g,"/").replace(/[TZ]/g," ")),
                diff = ((d.getTime() + (d.getTimezoneOffset()*60000) - date.getTime()) / 1000),
                day_diff = Math.floor(diff / 86400);

            return day_diff == 0 && (
                    diff < 60 && "just now" ||
                    diff < 120 && "1 min ago" ||
                    diff < 3600 && Math.floor( diff / 60 ) + " mins ago" ||
                    diff < 7200 && "1 hour ago" ||
                    diff < 86400 && Math.floor( diff / 3600 ) + " hours ago") ||
                day_diff == 1 && "Yesterday" ||
                day_diff < 7 && day_diff + " days ago" ||
                day_diff < 31 && Math.ceil( day_diff / 7 ) + " weeks ago";
        }

        var API = "./index.php?r=chat/from&id=";
        var s = {
            prettyDate: prettyDate,
            fetchMessagesFrom: function(userId) { 
                return $http.get(API+userId).then(function (resp){ return resp.data; });
            }
        };

        return s;
    }]);
})();

