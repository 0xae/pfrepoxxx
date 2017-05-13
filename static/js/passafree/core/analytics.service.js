(function () {
    angular.module('passafree')
    .factory('AnalyticsCore', ['$q', '$http', function ($q, $http) {
        function genTS(start,end) {
            if (!start.isValid() || !end.isValid()) {
                throw new Error('invalid range: '+start+' '+end);
            }

            var buf = [];
            var max = 366;
            var itr = moment(start);

            while (itr.isBefore(end)) {
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

        function getTimeline(start, end) {
            var ts = genTS(start, end);
            console.info(ts);
            var dict = {};
            ts.forEach(function (t) {
                var k = t.format('YYYY-MM-DD');
                dict[k] = 0;
            });
            return dict;
        }

        function getWeek(m) {
            var m1 = moment(m);
            var k = m1.weekday();
            m1.subtract(k, 'day');
            var m2 = moment(m1);
            m2.add(7, 'day');
            return [m1,m2];
        }

        function thisWeek() {
            var today = moment();
            var w = getWeek(today);
            return {
                start: moment(w[0]),
                end: moment(w[1])
            };
        }

        function parseTimeseries(start, end, data, dateCol, countCol){
            var timeline = getTimeline(start, end);
            data.forEach(function (d) {
                var time = _parseTimestamp(d[dateCol]);
                var k = moment(d[dateCol]).format('YYYY-MM-DD');
                if (timeline[k] == undefined) {
                    throw new Error('bad timeline');
                }
                timeline[k] += parseInt(d[countCol]);
            });

            var d = Object.keys(timeline).map(function (t) {
                return [_parseTimestamp(t), timeline[t]];
            });

            return _.sortBy(d, function(k){return k[0];});
        }

        return {
            generateTS: parseTimeseries,
            getWeek: getWeek,
            thisWeek: thisWeek
        };
    }]);
})();

