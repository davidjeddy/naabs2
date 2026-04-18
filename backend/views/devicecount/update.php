<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DeviceCountOptions */

$this->title = 'Update Device Count Options: ' . ' ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Device Count Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->key, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="device-count-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
