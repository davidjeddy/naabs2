<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;

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
            //'device_count_id',
            //'time_amount_id',
            //'user_id',
            [
                'label' => 'Length of Time',
                'value' => TimeAmountOptions::find()->where([
                    'id' => $model->getAttribute('time_amount_id')]
                )->one()->getAttribute('key'),
            ],
            [
                'label' => '# of Devices',
                'value' => DeviceCountOptions::find()->where([
                    'id' => $model->getAttribute('device_count_id')]
                )->one()->getAttribute('key'),
            ],
            'f_name',
            'l_name',
            'street_1',
            'street_2',
            'city',
            //'prov',
            [
                'label' => 'State / Prov.',
                'value' => $model->getAttribute('prov')
            ],
            'postal',
            'last_4',
            'price',
            'return_code',
            'return_message',
            'created_at:datetime',
            //'updated_at:datetime',
            //'deleted_at:datetime',
        ],
    ]) ?>

</div>
