<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TimeAmountOptions */

$this->title = 'Update Time Amount Options: ' . ' ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Time Amount Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="time-amount-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
