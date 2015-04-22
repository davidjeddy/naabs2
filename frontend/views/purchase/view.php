<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Purchase */

$this->title = 'Purchase Number: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php /*
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'device_count_id',
            'time_amount_id',
            //'user_id',
            'f_name',
            'l_name',
            'street_1',
            'street_2',
            'city',
            'prov',
            'postal',
            'last_4',
            //'timestamp:datetime',
            'return_code',
            'return_message',
            'created:datetime',
            'updated:datetime',
            //'deleted',
        ],
    ]) ?>

</div>
