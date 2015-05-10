<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\grid\GridView;
use yii\helpers\Html;

use common\models\Device;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History';
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $device = Device::find()
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

<?= GridView::widget([
    'dataProvider' => $deviceProvider,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],

        //'id',
        //'user_id',
        'device_name',
        'pass_phrase',
        'expiration:datetime',
        'created_at:datetime',
        //'updated_at:datetime',
        // 'deleted_at',

        //['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
    ],
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        //'id',
        //'device_count_id',
        //'time_amount_id',
        //'f_name',
        [
            'label' => 'Purchasers Name',
            'attribute' => 'f_name'
        ],
        'last_4',
        'price',
        'return_code',
        'return_message',
        'created_at:datetime',
        //'updated_at:datetime',
        // 'deleted_at:datetime',
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
    ],
]); ?>
