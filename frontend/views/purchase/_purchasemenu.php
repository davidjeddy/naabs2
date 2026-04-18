<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$device = \common\models\Device::find()
    ->select('id')
    ->where(['user_id' => Yii::$app->user->id])
    ->andWhere(['deleted_at' => NULL])
    ->all();


NavBar::begin();
$menuItems[] = ['label' => 'History',       'url' => ['/purchase/index']];

// if the user has no devices, show the init purchase form w/ device count AND time
if (!$device) {
    $menuItems[] = ['label' => 'Purchase',      'url' => ['/purchase/create']];
// else show the option to update time OR update device count
} else {
    $menuItems[] = ['label' => 'Add Device',    'url' => ['/purchase/adddevice']];
    $menuItems[] = ['label' => 'Add Time',      'url' => ['/purchase/addtime']];
}

// if the user has no devices then show the init 'purchase' VW option.
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => $menuItems,
]);
NavBar::end();
?>