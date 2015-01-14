<?php
if (YII_ENV == 'dev') {
	return [
		'class'    => 'yii\db\Connection',
		'dsn'      => 'mysql:host=10.3.2.111;dbname=testing',
		'username' => 'djeddie', 
		'password' => 'changeme123',
		'charset'  => 'utf8',
	];
} elseif (YII_ENV == 'sit') {
	return [
		'class'    => 'yii\db\Connection',
		'dsn'      => 'mysql:host=;dbname=',
		'username' => '', 
		'password' => '',
		'charset'  => 'utf8',
	];
} elseif (YII_ENV == 'prod') {
	return [
		'class'    => 'yii\db\Connection',
		'dsn'      => 'mysql:host=;dbname=',
		'username' => '', 
		'password' => '',
		'charset'  => 'utf8',
	];
} else {
	return [
		'class'    => 'yii\db\Connection',
		'dsn'      => 'mysql:host=;dbname=',
		'username' => '', 
		'password' => '',
		'charset'  => 'utf8',
	];
}
