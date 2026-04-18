<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\activeDropDownList;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use common\models\Country;
use common\models\DeviceCountOptions;
use common\models\TimeAmountOptions;

/* @var $this yii\web\View */
/* @var $purchase_mdl frontend\purchase_mdls\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $this->render('_purchasemenu'); ?>

<?php $form = ActiveForm::begin([
    'layout'                 => 'horizontal',
    'enableClientScript'     => true,
    'enableAjaxValidation'   => false,
    'enableClientValidation' => true,
    'validateOnChange'       => true,
]); ?>

<hr>
<h1>Service Options:</h1>

<div class="form-group field-purchase-type required">
    <div class="col-sm-6 col-sm-offset-3">
        <?= Html::activeDropDownList(
            $purchase_mdl,
            'device_count_id',
            ArrayHelper::map(DeviceCountOptions::find()->all(), 'id', 'key', 'cost'),
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
            ArrayHelper::map(TimeAmountOptions::find()->all(), 'id', 'key', 'cost'),
            [
                'prompt'=>'--Select Length of Time--',
                'class' => 'form-control'
            ]
        ) ?>
    </div>
</div>

<?= $this->render('_billing', [
    'form'         => $form,
    'purchase_mdl' => $purchase_mdl,
]); ?>

<?= $this->render('_payment', [
    'form'         => $form,
    'cc_format_mdl' => $cc_format_mdl,
]); ?>
   
<?= $this->render('_submitbuttons'); ?>

<?php ActiveForm::end(); ?>

<?= ( YII_DEBUG ? $this->render('_debugprefill') : null ); ?>
