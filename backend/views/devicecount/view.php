<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $model common\models\DeviceCountOptions */

$this->title = $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Device Count Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-count-options-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'class'     => DataColumn::className(),
                'attribute' => 'key',
                'format'    => 'text',
                'label'     => 'Count',
            ],
            'value',
            'cost',
            'created_at:datetime',
            'updated_at:datetime',
            //'deleted_at:datetime',
        ],
    ]) ?>

</div>
