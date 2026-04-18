<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_mac')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'device_name')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'user_id')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'created')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'updated')->textInput(['disabled' => true]) ?>

    <?php //$form->field($model, 'deleted')->textInput(['disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
