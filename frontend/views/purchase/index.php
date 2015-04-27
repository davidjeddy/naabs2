<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'device_count_id',
            //'time_amount_id',
            'f_name',
            'last_4',
            'return_code',
            'return_message',
            'created_at:datetime',
            //'updated_at',
            // 'deleted_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
