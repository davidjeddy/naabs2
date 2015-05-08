<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Country;

?>
<hr>
<h1>Billing Information:</h1>
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

<div class="form-group field-purchase-type required">
    <div class="col-sm-6 col-sm-offset-3">
        <?= Html::activeDropDownList(
            $purchase_mdl,
            'country_id',
            ArrayHelper::map(Country::find()->all(), 'id', 'value'),
            [
                'prompt'=>'--Select Country--',
                'class' => 'form-control'
            ]
        ) ?>
    </div>
</div>

<?= $form->field($purchase_mdl, 'user_id')->label(false)->hiddenInput([
    'value' => Yii::$app->user->getIdentity()->getAttribute('id')
]) ?>