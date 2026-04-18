<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $userDetails common\models\UserDetails */

$this->title = 'Update User Details: ' . ' ' . $userDetails->id;
$this->params['breadcrumbs'][] = ['label' => 'User Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $userDetails->id, 'url' => ['view', 'id' => $userDetails->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="time-amount-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $userDetails,
    ]) ?>

</div>
