<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php /*
    <p>
        <?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success']) ?>
    </p> */ ?>

    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'device_mac',
            'device_name',
            //'user_id',
            'created_at:datetime',
            'updated_at:datetime',
            // 'deleted_at',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}{update}'],
        ],
    ]); ?>

</div>
