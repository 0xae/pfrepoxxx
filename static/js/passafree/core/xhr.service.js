(function () {
    angular.module('passafree')
    .factory('AnalyticsCore', ['$q', '$http', function ($q, $http) {
        function genTS(start,end) {
            var buf = [];
            var max = 366;
            var itr = moment(start);

            while (max-- > 0) {
                if (itr.isSame(end)) {
                    buf.push(end);
                    break;
                } else {
                    buf.push(itr);
                }
                itr = moment(itr).add(1, 'day');
            }

            return buf;
        }

        function _parseTimestamp(date) {
            var m=moment(date);
            var year=parseInt(m.format("YYYY"));
            var month=parseInt(m.format("M"));
            var day=parseInt(m.format("D"));
            return Date.UTC(year, month, day);
        }

        function parseTimeseries(data, dateCol, countCol){
            var objs = data.map(function (d) {
                var time = parseTimestamp(d[dateCol]);
                return [time, parseInt(d[countCol])];
            });

            return [objs];
        }

        function __g1(start, end) {
            var ts = genTS(start, end);
            var dict = {};
            ts.forEach(function (t) {
                var k = t.format('YYYY-MM-DD');
                dict[k] = 1;
            });
        }

        return {
            generateTS: genTS
        };
    }]);
})();

