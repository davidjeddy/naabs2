<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_count_id')->textInput() ?>

    <?= $form->field($model, 'time_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'f_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'l_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'street_1')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'street_2')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'prov')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'postal')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'last_4')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'return_code')->textInput() ?>

    <?= $form->field($model, 'return_message')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'created')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'deleted')->textInput(['maxlength' => 45]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
