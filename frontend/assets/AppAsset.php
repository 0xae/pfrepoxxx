<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/skin/_all-skins.min.css',
        // 'css/skin/_all-skins.css',
        // 'css/bootstrap.min.css',
        'css/AdminLTE.min.css',
        'css/style.css',
        'css/AdminLTE.css',
        'css/site.css',
        'css/font-awesome.min.css',
        // 'css/skins/_all-skins.min.css',
        // 'css/blue.css',
        'css/circle.css',
    ];

    public $js = [
        'js/main.js',
        // 'js/app.min.js',
        // 'js/bootstrap.js',
        'js/bootstrap.min.js',
        'js/bootstrap.min.js',
        'js/moment.min.js',
        'js/app.js',
        'plugins/jquery.sparkline.min.js',
        'plugins/fastclick.min.js',
        'plugins/jquery.slimscroll.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
