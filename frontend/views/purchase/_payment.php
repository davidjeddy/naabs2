<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Country;

?>
<hr>
<h1>Payment Information:</h1>
<div class="form-group field-purchase-type required">
    <div class="col-sm-6 col-sm-offset-3">
        <?= Html::activeDropDownList(
            $cc_format_mdl,
            'type',
            [
                'discover'   => 'discover',
                'mastercard' => 'mastercard',
                'visa'       => 'visa',
            ],
            [
                'class'  => 'form-control',
                'prompt' =>'--Select Card Type--',
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
    'placeholder' => 'Expiration Month, 2 digit: 11',
]) ?>

<?= $form->field($cc_format_mdl, 'exp_year')->label(false)->textInput([
    'maxlength' => 4,
    'placeholder' => 'Expiration Year, 4 digit: 2018',
]) ?>

<?= $form->field($cc_format_mdl, 'cvv2')->label(false)->textInput([
    'maxlength' => 4,
    'placeholder' => 'CVV2 Number',
]) ?>

<?php /*
<?= $form->field($purchase_mdl, 'created_at')->textInput(['maxlength' => 45]) ?>
<?= $form->field($purchase_mdl, 'deleted_at')->textInput(['maxlength' => 45]) ?>
<?= $form->field($purchase_mdl, 'return_code')->textInput() ?>
<?= $form->field($purchase_mdl, 'return_message')->textInput(['maxlength' => 45]) ?>
<?= $form->field($purchase_mdl, 'updated')->textInput(['maxlength' => 45]) ?>
*/ ?>
   