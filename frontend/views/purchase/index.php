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

<?= $this->render('_purchasemenu'); ?>

<?= GridView::widget([
    'dataProvider' => $deviceProvider,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],

        //'id',
        //'user_id',
        //'device_name',
        [
            'label'     => 'Device Username',
            'attribute' => 'device_name'
        ],
        //'pass_phrase',
        [
            'label'     => 'Device Passphrase',
            'attribute' => 'pass_phrase'
        ],
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
