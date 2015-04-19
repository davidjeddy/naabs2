<?php
return [
    'components'    => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName'  => 'false',
        ],
    ],
   'modules' => [
        'FreeRadius' => [
            'class' => 'backend\modules\FreeRadius\Module',
        ],
    ],
    'vendorPath'    => dirname(dirname(__DIR__)) . '/vendor',
];


