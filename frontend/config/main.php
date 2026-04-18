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
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'paypal'=> [
            'class'        => 'marciocamello\Paypal',
            'clientId'     => 'you_client_id',
            'clientSecret' => 'you_client_secret',
            'isProduction' => false,
             // This is config file for the PayPal system
             'config'       => [
                'http.ConnectionTimeOut' => 30,
                'http.Retry'             => 1,
                'mode'                   => 'sandbox', //\marciocamello\Paypal::MODE_SANDBOX, // development (sandbox) or production (live) mode
                'log.LogEnabled'         => YII_DEBUG ? 1 : 0,
                'log.FileName'           => '@runtime/logs/paypal.log',
                'log.LogLevel'           => 'FINE', //\marciocamello\Paypal::LOG_LEVEL_FINE,
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        /*'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/stargazers'],
                'baseUrl' => '@web/themes/stargazers',
            ]
        ],*/
    ],
    'params' => $params,
];