<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    //'defaultRoute' => 'site/login',


    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            /**/
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
                'path'=>'/frontend/web'  // correct path for the frontend app.
            ],/**/
        ],

        /**/
        'session' => [
            'name' => '_frontendSessionId', // unique for frontend
            'savePath' => __DIR__ . '/../runtime', // a temporary folder on frontend
        ],/**/

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mycomponent' => [
 
            'class' => 'backend\components\MyComponent',
 
            ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                'history'=>'evento/history',
                ''=>'site/index',
                'logout'=>'site/logout',
                '<id:\d+>'=>'evento/view',
                'validate/<idevento:\d+>'=>'evento/validate',
                'uservalidate/<iduser:\d+>/<idevento:\d+>'=>'evento/uservalidate',
                '<controller>/<action>/<iduser:\d+>/<idevento:\d+>'=>'<controller>/<action>',
            ],
        ],

    ],
    'params' => $params,
];
