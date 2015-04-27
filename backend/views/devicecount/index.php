<?php

use yii\helpers\Html;

use yii\grid\DataColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Device Count Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-count-options-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Device Count Options', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'class'     => DataColumn::className(),
                'attribute' => 'key',
                'format'    => 'text',
                'label'     => 'Count',
            ],
            'cost',
            'created_at:datetime',
            'updated_at:datetime',
            // 'deleted_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
