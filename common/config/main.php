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
    ],
    'vendorPath'    => dirname(dirname(__DIR__)) . '/vendor',
];


