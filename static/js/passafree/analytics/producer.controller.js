(function () {
    angular.module('analyticsModule')
    .controller('ProducerAnalyticsController', ['AnalyticsService', 'AnalyticsCore', '$scope', 
    function (analyticsService, analyticsCore, $scope) {
        function loadData(config) {
            analyticsService.fetchAnalyticsData(config.start, config.end)
            .then(function (data) {
                var pdata = data.producer_statistics;

                loadMostPopularG(pdata.most_popular);
                loadTopSellersG(pdata.top_seller);
                loadMostProfitableG(pdata.most_profitable);
                loadProducerGrowth(pdata.producer_growth);
                loadRevenueGrowth(pdata.revenue_growth);
                loadEventGrowth(pdata.events_growth);
            });
        }

        function loadMostPopularG(data) {
            var ks = data.map(function (d) { return d.marca_nome });
            var vs = data.map(function (d) { return parseInt(d.evento_likes) + parseInt(d.evento_comments); });
            var total = _.sumBy(vs, function (e) { return e; });
            if (!total) {
                $scope.no_populars_data = true;
            } else {
                $scope.no_populars_data = false;
            }
            LoadBarchart('#most_popular', '', ks, vs);
            var totalReaction = 0;
            var totalLikes = 0;
            var totalComments = 0;
            var most_popular = data;

            most_popular.forEach(function (p) {
                totalReaction += parseInt(p.total_reaction);
                totalLikes += parseInt(p.evento_likes);
                totalComments += parseInt(p.evento_comments);
            });

            most_popular.forEach(function (p) {
                if (totalReaction) p.reaction_percent = (p.total_reaction/totalReaction) * 100;
                if (totalLikes) p.likes_percent = (p.evento_likes/totalLikes) * 100;
                if (totalComments) p.comments_percent = (p.evento_comments/totalComments) * 100;
            });

            $scope.producers = most_popular;
        }

        function loadTopSellersG(data) {
            var ks = data.map(function (d) { return d.producer_name; });
            var vs = data.map(function (d) { return parseInt(d.gross_revenue); });
            var total = _.sumBy(vs, function (e) { return e; });

            if (!total) {
                $scope.no_sellers_data = true;
            } else {
                $scope.no_sellers_data = false;
            }

            $scope.topSellers = data;
            LoadBarchart('#top_sellers', '', ks, vs);
        }

        function loadMostProfitableG(data) {
            var ks = data.map(function (d) { return d.producer_name; });
            var vs = data.map(function (d) { return parseInt(d.context_revenue); });
            var total = _.sumBy(vs, function (e) { return e; });

            if (!total) {
                $scope.no_profit_data = true;
            } else {
                $scope.no_profit_data = false;
            }

            $scope.topProfits = data;
            LoadBarchart('#most_profitable', '', ks, vs);
        }

        function loadProducerGrowth(data) {
            console.info("data is: ", data);
            var cats = data.map(function (e) { return e.period; });
            var data = data.map(function (e) { return parseInt(e.total_producers); })
            LoadGrowthSeries('producer_growth', cats, '# Producers', data);
        }

        function loadRevenueGrowth(data) {
            var cats = data.map(function (e) { return e.period; });
            var data = data.map(function (e) { return parseInt(e.business_revenue); })
            LoadGrowthSeries('revenue_growth', cats, 'Business Revenue', data);
        }

        function loadEventGrowth(data) {
            var cats = data.map(function (e) { return e.period; });
            var data = data.map(function (e) { return parseInt(e.total_events); })
            LoadGrowthSeries('event_growth', cats, '# Events', data);
        }

        var thisWeek = analyticsCore.thisWeek();
        loadData(thisWeek);
        $('#producer_daterange').daterangepicker({
            "startDate": thisWeek.start.format('MM/DD/YYYY'),
            "endDate": thisWeek.end.format('MM/DD/YYYY'),
            "linkedCalendars": false,
        }, function(start, end, label) {
            var conf = {start: start, end: end};
            loadData(conf);
        });


    }]);
})();

