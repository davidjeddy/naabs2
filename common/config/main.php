<?php
return [
    'components'    => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName'  => true,
        ],
        'paypal' => [
            'class'        => 'davidjeddy\Paypal',
            'clientId'     => 'AUajDzkB-sXyOMjxvWHaf9BBXAIaZea1nBEg8Fhzk5VIR7ruy73gweSDbImrbi9hZL1PVcyJKT55bz-A',
            'clientSecret' => 'EIkPednUQnhfYTm9TbqBxOB9X-kp7FK5Ij8J8YGq2ywhFTBpEY_0uXX0p-qPLEMm5txrXJyEKl6UneJY',
            'isProduction' => false,
            'config'       => [
                'http.ConnectionTimeOut' => 30,
                'http.Retry'             => 1,
                'mode'                   => \davidjeddy\Paypal::MODE_SANDBOX, // development (sandbox) or production (live) mode
            ],
            'log' => [
                'FileName'   => '@runtime/logs/paypal.log',
                'LogEnabled' => YII_DEBUG ? 1 : 0,
                'LogLevel'   => \davidjeddy\Paypal::LOG_LEVEL_FINE,
            ]
        ],
    ],
    'vendorPath'    => dirname(dirname(__DIR__)) . '/vendor',
];


