<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Time Amount Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-amount-options-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Time Amount Options', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'key',
            [
                'class'     => DataColumn::className(),
                'attribute' => 'key',
                'format'    => 'text',
                'label'     => 'Name',
            ],
            //'value',
            'cost',
            'created_at:datetime',
            'updated_at:datetime',
            // 'deleted_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
