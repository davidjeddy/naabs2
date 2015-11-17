<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'device_name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'pass_phrase')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'expiration')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput(['disabled' => true]) ?>

    <?php //$form->field($model, 'deleted_at')->textInput(['disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
