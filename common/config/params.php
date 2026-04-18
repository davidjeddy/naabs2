<?php
return [
	'adminEmail'                    => 'admin@naabs2.com',
	'supportEmail'                  => 'suppot@naabs2.com',
	'user.passwordResetTokenExpire' => 3600,
    'paypal' => [
		'setReturnUrl'  => $_SERVER['HTTP_HOST'],
		'setCancelUrl'  => $_SERVER['HTTP_HOST'],
		'currency'      => 'USD',
		'tax_rate'      => 0.07,
		'shipping_rate' => 0.00,
		'transaction'	=> [
			'desc' => 'Wireless network access.',
		],
		'intent'   => 'sale',
    ]
];
