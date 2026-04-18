<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            'device_name',
            // 'user_id',
            // todo get this to work via model relations - DJE - 2015-11-20
            [
                'label' => 'user',
                'value' => function ($model) {
                    return \common\models\User::find()->andWhere(['id' => $model->user_id])->one()->username;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            // 'deleted_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
