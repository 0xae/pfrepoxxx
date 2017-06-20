(function () {
    angular.module('chatModule')
    .factory('ChatService', ['$http', function ($http) {
        var API = "./index.php?r=chat";
        function prettyDate(time) {
            var d = new Date();
            var date = new Date((time || "").replace(/-/g,"/").replace(/[TZ]/g," "));
            var diff = ((d.getTime() - date.getTime()) / 1000);
            var day_diff = Math.floor(diff / 86400);

            if (diff<0 && day_diff<0) {
                return 'just now';
            }

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

        return {
            prettyDate: prettyDate,
            fetchMessagesFrom: function(userId) { 
                return $http.get(API+"/from&id="+userId).then(function (resp){ return resp.data; });
            },

            fetchUnreadFrom: function (userId) {
                return $http.get(API+"/unread-from&id="+userId).then(function (resp){ return resp.data; });
            },

            fetchConversations: function () {
                return $http.get(API+"/conversations").then(function (resp){ return resp.data; });
            },

            fetchUnread: function () {
                return $http.get(API+"/unread").then(function (resp){ return resp.data; });
            }
        };
    }]);
})();

