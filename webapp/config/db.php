<?php
if (YII_ENV == 'dev') {
	return [
		'class'    => 'yii\db\Connection',
		'dsn'      => 'mysql:host=localhost;dbname=naabs2',
		'username' => 'root', 
		'password' => 'root',
		'charset'  => 'utf8',
	];
} elseif (YII_ENV == 'sit') {
	return [
		'class'    => 'yii\db\Connection',
		'dsn'      => 'mysql:host=localhost;dbname=naabs2',
		'username' => 'root', 
		'password' => 'root',
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
