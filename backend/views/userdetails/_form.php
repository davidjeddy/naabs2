<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'f_name')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'l_name')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'p_phone')->textInput() ?>

    <?= $form->field($model, 's_phone')->textInput() ?>

    <?= $form->field($model, 't_phone')->textInput() ?>

    <?= $form->field($model, 's_question')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 's_answer')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'p_email')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 's_email')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
