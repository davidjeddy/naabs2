<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserDetails */

$this->title = 'Update User Details: ' . ' ' . $model->f_name;
$this->params['breadcrumbs'][] = ['label' => 'Time Amount Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->f_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="time-amount-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
