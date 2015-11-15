<?php
return [
	'adminEmail'                    => 'admin@naabs2.com',
	'supportEmail'                  => 'suppot@naabs2.com',
	'user.passwordResetTokenExpire' => 3600,
    'paypal' => [
        'currency'      => 'USD',
        'intent'        => 'sale',
        'setCancelUrl'  => isset($_SERVER["HTTP_HOST"]) ?: false,
        'setReturnUrl'  => isset($_SERVER["HTTP_HOST"]) ?: false,
        'shipping_rate' => 0.00,
        'tax_rate'      => 0.07,
        'transaction'   => ['desc' => 'Wireless network access.',],
    ]
];
