<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TimeAmountOptions */

$this->title = 'Create Time Amount Options';
$this->params['breadcrumbs'][] = ['label' => 'Time Amount Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-amount-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
