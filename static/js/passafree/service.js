function AnalyticsService() {
    var API = './index.php?r=analytics';

    function _parse(pr) {
        return pr.then(function (d) {
            return JSON.parse(d);
        }); 
    }

    function process(filters) {
        var fkeys = Object.keys(filters);
        var buf = [];
        fkeys.forEach(function (f) { 
            var fval = filters[f];          
            if ($.isPlainObject(fval)) {
                var k=Object.keys(fval)[0];
                var ffval = fval[k]; 
                buf.push(f+'='+k+':'+ffval);
            } else {
                buf.push(f+'='+fval);
            }
        });
        return '&' + buf.join('&');
    }

    return {
        getDashboard : function (filters) {
            var conf = {};
            if (filters.start && filters.end) {
            }

            var filtersf = process(conf);
            return _parse($.get(API+'/dashboard'+filtersf));
        },

        getReports : function (filters) {
            var filtersf = process(filters);
            return _parse($.get(API+'/dashboard'+filtersf));
        },

        get: function (endp, filters) {
            var filtersf = process(filters);
            endp = endp || '';
            return _parse($.get(API+endp+filtersf));
        }
    };
}

