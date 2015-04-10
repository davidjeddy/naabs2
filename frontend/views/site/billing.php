<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use common\models\TimeAmountOptions;

/* @var $this yii\web\View */
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
		    <?php $form = ActiveForm::begin(['id' => 'user-billing']); ?>
				<?= Html::DropDownList(
					'time-options',
					null,
					ArrayHelper::map(TimeAmountOptions::find()->all(), 'id', 'key'),
					['class'  => 'form-control']
				); ?>

				<hr>

				<div>
					<?= Html::Input(
						'input',
						'f_name',
						null,
						['placeholder' => 'First Name', 'class' => 'form-control']
					); ?>

					<?= Html::Input(
						'input',
						'l_name',
						null,
						['placeholder' => 'Last Name', 'class' => 'form-control']
					); ?>

					<?= Html::Input(
						'input',
						'street_1',
						null,
						['placeholder' => 'Street 1', 'class' => 'form-control']
					); ?>

					<hr>

					<?= Html::Input(
						'input',
						'street_2',
						null,
						['placeholder' => 'Street 2', 'class' => 'form-control']
					); ?>

					<?= Html::Input(
						'input',
						'city',
						null,
						['placeholder' => 'City Name', 'class' => 'form-control']
					); ?>

					<?= Html::Input(
						'input',
						'prov',
						null,
						['placeholder' => 'State / Prov', 'class' => 'form-control']
					); ?>

					<?= Html::Input(
						'input',
						'postal',
						null,
						['placeholder' => 'Zip / Postal Code', 'class' => 'form-control']
					); ?>

					<?= Html::Input(
						'input',
						'country',
						null,
						['placeholder' => 'Country', 'class' => 'form-control']
					); ?>

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
		            <?= Html::resetButton('Clear Form',       ['class' => 'btn btn-default', 'name' => 'billing-form-reset']) ?>
		            <?= Html::submitButton('Submit Payment',  ['class' => 'btn btn-primary', 'name' => 'billing-form-submit']) ?>
		        </div>
		    <?php ActiveForm::end(); ?>
        </div>
        <div class="tab-pane" id="orange">
            <h1>Active</h1>
            <p>Currently active purchase</p>
        </div>
        <div class="tab-pane" id="yellow">
            <h1>History</h1>
            <p>History of users purchases.</p>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script> 