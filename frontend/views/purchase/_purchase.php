<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $purchase_mdl frontend\purchase_mdls\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<h1>Billing Information:</h1>
<?php $form = ActiveForm::begin([
    'layout'                 => 'horizontal',
    'enableClientScript'     => true,
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'validateOnChange'       => true,
]); ?>

<?php /*
<?= $form->field($purchase_mdl, 'device_count_id')->textInput() ?>
<?= $form->field($purchase_mdl, 'time_id')->textInput() ?>
<?= $form->field($purchase_mdl, 'user_id')->textInput() ?>
*/ ?>

<?= $form->field($purchase_mdl, 'f_name')->label(false)->textInput([
    'maxlength'  => 45,
    'placeholder' => 'First Name'
]) ?>

<?= $form->field($purchase_mdl, 'l_name')->label(false)->textInput([
    'maxlength' => 45,
    'placeholder' => 'Last Name',
    
]) ?>

<?= $form->field($purchase_mdl, 'street_1')->label(false)->textInput([
    'maxlength' => 45,
    'placeholder' => 'Street 1',
]) ?>

<?= $form->field($purchase_mdl, 'street_2')->label(false)->textInput([
    'maxlength' => 45,
    'placeholder' => 'Street 2',
]) ?>

<?= $form->field($purchase_mdl, 'city')->label(false)->textInput([
    'maxlength' => 45,
    'placeholder' => 'City',
]) ?>

<?= $form->field($purchase_mdl, 'prov')->label(false)->textInput([
    'maxlength' => 45,
    'placeholder' => 'State / Prov.',
]) ?>

<?= $form->field($purchase_mdl, 'postal')->label(false)->textInput([
    'maxlength' => 45,
    'placeholder' => 'ZIP / Postal Code',
]) ?>

<hr>

<h1>Payment Information:</h1>
<?= $form->field($cc_format_mdl, 'number')->label(false)->textInput([
    'maxlength' => 24,
    'placeholder' => 'Card Number',
]) ?>

<?= $form->field($cc_format_mdl, 'exp_month')->label(false)->textInput([
    'maxlength' => 2,
    'placeholder' => 'Expiration Month',
]) ?>

<?= $form->field($cc_format_mdl, 'exp_year')->label(false)->textInput([
    'maxlength' => 4,
    'placeholder' => 'Expiration Year',
]) ?>

<?= $form->field($cc_format_mdl, 'cvv2')->label(false)->textInput([
    'maxlength' => 4,
    'placeholder' => 'CVV2 Number',
]) ?>

<?php /*
<?= $form->field($purchase_mdl, 'created')->textInput(['maxlength' => 45]) ?>
<?= $form->field($purchase_mdl, 'deleted')->textInput(['maxlength' => 45]) ?>
<?= $form->field($purchase_mdl, 'return_code')->textInput() ?>
<?= $form->field($purchase_mdl, 'return_message')->textInput(['maxlength' => 45]) ?>
<?= $form->field($purchase_mdl, 'updated')->textInput(['maxlength' => 45]) ?>
*/ ?>
   
<div class="form-group pull-right">
    <?= Html::resetButton('Reset',   ['class' => 'btn btn-default']) ?>
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    <?php /*<?= Html::submitButton($purchase_mdl->isNewRecord ? 'Create' : 'Update', ['class' => $purchase_mdl->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>*/ ?>
</div>

<?php ActiveForm::end(); ?>

<?php if (YII_DEBUG) { //pre-populate form when testing ?>
<script>

</script>
<?php } ?>