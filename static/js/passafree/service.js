function AnalyticsService() {
    function _parse(pr) {
        return pr.then(function (d) {
            return JSON.parse(d);
        }); 
    }

    return {
        getDashboard: function () {
            return _parse($.get('./index.php?r=analytics/dashboard-business'));
        },

        getEventsPerBusiness: function () {
            return _parse($.get('./index.php?r=analytics/events-per-business'));
        },

        getSalesPerEvent: function () {
            return _parse($.get('./index.php?r=analytics/sales-per-event'));
        },

        getSalesPerProducer: function () {
            return _parse($.get('./index.php?r=analytics/sales-per-producer'));
        },

        getSalesPerBusiness: function () {
            return _parse($.get('./index.php?r=analytics/sales-per-business'));
        }
    };
}

