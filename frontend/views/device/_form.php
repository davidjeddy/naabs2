<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_mac')->textInput(['maxlength' => 32, 'disabled' => true]) ?>

    <?= $form->field($model, 'device_name')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'created_at')->textInput(['disabled' => true]) ?>

    <?php //= $form->field($model, 'updated_at')->textInput() ?>

    <?php //= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
