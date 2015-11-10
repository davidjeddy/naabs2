<?php
/**
 * Application configuration shared by all applications and test types
 */
return [
    'components' => [
        'db' => [
            'charset'  => 'utf8',
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=localhost;dbname=yii2_advanced_tests',
            'password' => '',
            'username' => 'root',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
