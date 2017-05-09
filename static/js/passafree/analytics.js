$(document).ready(function () {
    var $s = AnalyticsService();

    $s.get('/user', {})
    .then(function (resp) {
        loadUserGrowth(resp.data);
    });
    
    $s.get('/reactions', {})
    .then(function (resp) {
        loadInterationGrowth(resp.data);
    });

    // just for testing purposes
    // LoadTimeseriesChart('usage_growth', [__data]);

    function loadUserGrowth(data){
        var objs = data.map(function (d) {
            var time = parseTimestamp(d.date);
            return [time, parseInt(d.total_registrations)];
        });

        LoadTimeseriesChart('user_growth', [objs]);
    }

    function loadInterationGrowth(data){
        var likes = data.map(function (d) {
            var t=parseTimestamp(d.date);
            return [t, parseInt(d.total_likes)]; 
        });

        var comments = data.map(function (d) { var t=parseTimestamp(d.date); return [t, parseInt(d.total_comments)]; });
        var objs = [likes];

        LoadTimeseriesChart('interaction_growth', objs);
    }

    function parseTimestamp(date) {
        var m=moment(date);
        var year=parseInt(m.format("YYYY"));
        var month=parseInt(m.format("M"));
        var day=parseInt(m.format("D"));

        return Date.UTC(year, month, day);
    }
});


