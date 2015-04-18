<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\activeDropDownList;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;

/* @var $this yii\web\View */
/* @var $purchase_mdl frontend\purchase_mdls\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'layout'                 => 'horizontal',
    'enableClientScript'     => true,
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'validateOnChange'       => true,
]); ?>



<hr>
<h1>Billing Information:</h1>
<?php /*
<?= $form->field($purchase_mdl, 'device_count_id')->textInput() ?>
<?= $form->field($purchase_mdl, 'time_id')->textInput() ?>
*/ ?>
<?= $form->field($purchase_mdl, 'user_id')->label(false)->textInput([
    'value' => Yii::$app->user->getIdentity()->getAttribute('id')
]) ?>


<div class="form-group field-purchase-type required">
    <div class="col-sm-6 col-sm-offset-3">
        <?= Html::activeDropDownList(
            $purchase_mdl,
            'device_count_id',
            ArrayHelper::map(DeviceCountOptions::find()->all(), 'id', 'cost', 'key'),
            [
                'prompt'=>'--Select Number of Devices--',
                'class' => 'form-control'
            ]
        ) ?>
    </div>
</div>

<div class="form-group field-purchase-type required">
    <div class="col-sm-6 col-sm-offset-3">
        <?= Html::activeDropDownList(
            $purchase_mdl,
            'time_amount_id',
            ArrayHelper::map(TimeAmountOptions::find()->all(), 'id', 'cost', 'key'),
            [
                'prompt'=>'--Select Length of Time--',
                'class' => 'form-control'
            ]
        ) ?>
    </div>
</div>

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
<div class="form-group field-purchase-type required">
    <div class="col-sm-6 col-sm-offset-3">
        <?= Html::activeDropDownList(
            $cc_format_mdl,
            'type',
            [1 => 'discover', 2 => 'mastercard', 3 => 'visa'],
            [
                'prompt'=>'--Select Card Type--',
                'class' => 'form-control'
            ]
        ) ?>
    </div>
</div>

<?= $form->field($cc_format_mdl, 'number')->label(false)->textInput([
    'maxlength' => 16,
    'placeholder' => 'Card Number',
]) ?>

<?= $form->field($cc_format_mdl, 'exp_month')->label(false)->textInput([
    'maxlength' => 2,
    'placeholder' => 'Expiration Month',
]) ?>

<?= $form->field($cc_format_mdl, 'exp_year')->label(false)->textInput([
    'maxlength' => 2,
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
// jQuery is loaded after the page completes, wait for Window.onload to be valid.   
window.onload=function(){
    $("#purchase-f_name").val('qwer');
    $("#purchase-l_name").val('asdf');
    $("#purchase-street_1").val('123 zxc');
    $("#purchase-street_2").val();
    $("#purchase-city").val('qwer');
    $("#purchase-prov").val('asdf');
    $("#purchase-postal").val('asd123');

    $("#ccformat-number").val('1234567887654321');
    $("#ccformat-exp_month").val('01');
    $("#ccformat-exp_year").val('14');
    $("#ccformat-cvv2").val('1234');

    $("#purchase-device_count_id optgroup   > option:eq(1)").prop('selected', true);
    $("#purchase-time_amount_id  optgroup   > option:eq(2)").prop('selected', true);
    $("#ccformat-type                       > option:eq(3)").prop('selected', true);
};
</script>
<?php } ?>