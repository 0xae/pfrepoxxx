<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*'css/bootstrap.min.css',
        'css/style.css',
        'css/hover.css',
        'css/hover-min.css',
        
        
        'css/skin/_all-skins.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',*/
        'css/skin/_all-skins.min.css',
        'css/bootstrap.min.css',
        'css/AdminLTE.min.css',
        'css/style.css',
        'css/AdminLTE.css',
        'css/site.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'css/skins/_all-skins.min.css',
        'css/blue.css',
        
    ];
    public $js = [
        //'js/plugins/jQuery-2.1.4.min.js',
        //'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        //'js/dashboard.js',
        'js/app.min.js',
        'js/bootstrap.js',
        'js/bootstrap.min.js',
        'js/bootstrap.min.js',
        //'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
        'js/app.js',
        'plugins/jquery.sparkline.min.js',
        'plugins/fastclick.min.js',
        'plugins/jquery.slimscroll.min.js',
       	//'js/dashboard.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset'
    ];
}
