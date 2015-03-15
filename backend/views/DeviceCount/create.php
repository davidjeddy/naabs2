<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DeviceCountOptions */

$this->title = 'Create Device Count Options';
$this->params['breadcrumbs'][] = ['label' => 'Device Count Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-count-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
