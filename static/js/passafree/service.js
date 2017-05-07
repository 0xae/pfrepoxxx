function AnalyticsService() {
    var API = './index.php?r=analytics/dashboard';

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
        return buf.join('&');
    }

    return {
        getReports : function (filters) {
            var filtersf = process(filters);
            return _parse($.get(API+filtersf));
        }
    };
}

