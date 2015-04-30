<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'FreeRadius' => [
            'class' => 'backend\modules\FreeRadius\FreeRadius',
        ],
    ],
    'components' => [
        'errorHandler'  => [
            'errorAction' => 'site/error',
        ],
        'log'           => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user'          => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'view'          => [
            //'theme' => 'vova07\themes\admin\Theme'
        ],
    ],
    'params' => $params,
];
