<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\Purchase */

use yii\helpers\ArrayHelper;
use common\models\TimeAmountOptions;

$this->title = 'Billing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Purchase more time or view the time you have now.</p>

<div class="container">
 
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#red" data-toggle="tab">Purchase</a></li>
        <li><a href="#orange" data-toggle="tab">Active</a></li>
        <li><a href="#yellow" data-toggle="tab">History</a></li>
    </ul>



    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="red">
            <h1>Purchase</h1>
            <?php $form = ActiveForm::begin([
				'action'               => ['site/billing'],
				'enableAjaxValidation' => true,
				'enableClientScript'   => true,
				'errorCssClass'        => '.has-error',
				'id'                   => 'purchasing',
				'layout'               => 'horizontal',
				'method'               => 'post',
				'validateOnBlur'       => true,
				'validateOnChange'     => true,
				'validationDelay'      => 250,
			]); ?>

<?php 
//use app\models\Country;
$countries=TimeAmountOptions::find()->all();

//use yii\helpers\ArrayHelper;
$listData=ArrayHelper::map($countries,'id','key');

echo $form->field(null, 'time-options')->dropDownList( $listData );
?>


			<hr>
			<div>
				<?= $form->field($purchas_mdl, 'f_name') ?>
				<?= $form->field($purchas_mdl, 'l_name') ?>
				<?= $form->field($purchas_mdl, 'street_1') ?>
				<?= $form->field($purchas_mdl, 'street_2') ?>
				<?= $form->field($purchas_mdl, 'city') ?>
				<?= $form->field($purchas_mdl, 'prov') ?>
				<?= $form->field($purchas_mdl, 'postal') ?>
				<?= $form->field($purchas_mdl, 'country') ?>
			</div>
			<hr>
			<div>
				<?php
				$date_time_data = [];
				for ($counter = 1; $counter <= 12; $counter++) {
				    $date_time_data['months'][] = date('F', mktime(0,0,0,$counter, 1, date('Y')));
				}

				$current_year = date('Y');
				for ($counter = 0; $counter <= 5; $counter++) {
					$date_time_data['years'][] = date('Y', mktime(0,0,0,1,1,($current_year+$counter)));
				}
				?>

				<?= Html::DropDownList(
					'time-options',
					null,
					['Mastercard', 'Visa', 'American Express'],
					['class'  => 'form-control']
				); ?>

				<?= Html::DropDownList(
					'[cc]month',
					null,
					$date_time_data['months'],
					['class'  => 'form-control']
				); ?>

				<?= Html::DropDownList(
					'[cc]year',
					null,
					$date_time_data['years'],
					['class'  => 'form-control']
				); ?>

				<?= Html::Input(
					'input',	
					'cvv2',
					null,
					['placeholder' => 'CVV2', 'class' => 'form-control']
				); ?>
			</div>
			<hr>
	        <div class="form-group">
	            <?= Html::resetButton('Clear Form',
	            	['class' => 'btn btn-default btn-sm', 'name' => 'billing-form-reset']) ?>
	            <?= Html::submitButton('Submit Payment',
	            	['class' => 'btn btn-primary btn-lg pull-right', 'name' => 'billing-form-submit']) ?>
	        </div>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="tab-pane" id="orange">
            <h1>Active</h1>
            <p>Currently active plan and time.</p>
        </div>

        <div class="tab-pane" id="yellow">
            <h1>History</h1>
            <p>Your purchases.</p>
        </div>
    </div>

</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>