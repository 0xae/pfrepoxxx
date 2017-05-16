<?php
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/AdminLTE.min.css',
        'static/css/style.css',
        'static/css/site.css',
        'static/css/circle.css',
        'static/css/dashboard.css',
        'static/css/ionicons.min.css',
        'static/css/font-awesome.min.css',
        'static/css/skins/_all-skins.min.css',
        'static/lib/daterange/daterangepicker.css',
        // 'static/css/AdminLTE.css',
    ];

    public $js = [
        'static/js/bootstrap.min.js',
        'static/js/moment.min.js',
        'static/js/app.js',
        'static/js/lodash.js',
        'static/js/highcharts.js',
        'static/js/lodash.js',
        'static/js/statistics.js',
        'static/lib/angular.min.js',
        'static/lib/daterange/daterangepicker.js',
        'static/lib/moment/moment-range.min.js',
        'static/plugins/jquery.sparkline.min.js',
        'static/plugins/fastclick.min.js',
        'static/plugins/jquery.slimscroll.min.js',
        'static/js/jquery.steps.min.js',

        /* App */
        'static/js/passafree/app.js',
        'static/js/passafree/core/analytics.service.js',

        /* Event Module */
        'static/js/passafree/events/event.module.js',
        'static/js/passafree/events/event.service.js',
        'static/js/passafree/events/event.controller.js',

        /* Analytics Module */
        'static/js/passafree/analytics/mod.module.js',
        'static/js/passafree/analytics/mod.service.js',
        'static/js/passafree/analytics/producer.controller.js',
        'static/js/passafree/analytics/user.controller.js',

        /* User Module */
        'static/js/passafree/user/mod.module.js',
        'static/js/passafree/user/mod.service.js',
        'static/js/passafree/user/mod.controller.js',

        /* Dashboard Module */
        'static/js/passafree/dashboard/dashboard.js',

        // TODO: remove these
        'static/js/passafree/service.js',
        'static/js/dumps/timeseries.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset'
    ];
}

