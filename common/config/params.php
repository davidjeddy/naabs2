<?php
return [
	'adminEmail'                    => 'admin@windnetworks.net',
	'supportEmail'                  => 'support@windnetworks.net',
    'supportPhone'                  => '+1 (352) 577 5127',
	'user.passwordResetTokenExpire' => 3600,
    'components' => [
        'paypal'=> [
            'class'        => 'marciocamello\Paypal',
            'clientId'     => 'you_client_id',
            'clientSecret' => 'you_client_secret',
            'isProduction' => false,
            // This is config file for the PayPal system
            'config'       => [
                'http.ConnectionTimeOut' => 30,
                'http.Retry'             => 1,
                'log.FileName'           => '@runtime/logs/paypal.log',
                'log.LogEnabled'         => YII_DEBUG ? 1 : 0,
                'log.LogLevel'           => \marciocamello\Paypal::LOG_LEVEL_FINE,
                // development (sandbox) or production (live) mode
                'mode'                   => \marciocamello\Paypal::MODE_SANDBOX, 
            ]
        ],
    ],
];