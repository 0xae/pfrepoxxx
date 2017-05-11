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
        // 'static/css/AdminLTE.css',
        'static/css/site.css',
        'static/css/circle.css',
        'static/css/font-awesome.min.css',
        'static/css/ionicons.min.css',
        'static/css/skins/_all-skins.min.css',
        'static/css/dashboard.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
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
        'static/plugins/jquery.sparkline.min.js',
        'static/plugins/fastclick.min.js',
        'static/plugins/jquery.slimscroll.min.js',
        'static/js/jquery.steps.min.js',
        'static/js/passafree/app.js',

        /* Event Module */
        'static/js/passafree/events/event.module.js',
        'static/js/passafree/events/event.service.js',
        'static/js/passafree/events/event.controller.js',

        /* Analytics Module */
        'static/js/passafree/analytics/mod.module.js',
        'static/js/passafree/analytics/mod.service.js',
        'static/js/passafree/analytics/mod.controller.js',

        'static/js/passafree/service.js',
        'static/js/passafree/dashboard.js',
        'static/js/passafree/produtor.js',
        // TODO: remove this
        'static/js/dumps/timeseries.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset'
    ];
}
