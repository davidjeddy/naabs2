<?php
return [
    'components'    => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
        ],
    ],
    'vendorPath'    => dirname(dirname(__DIR__)) . '/vendor',
];


