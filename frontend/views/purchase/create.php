<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Purchase */

$this->title = 'Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_purchase', [
		'cc_format_mdl'            => $cc_format_mdl,
		'country_mdl'              => $country_mdl,
		'device_count_options_mdl' => $device_count_options_mdl,
		'purchase_mdl'             => $purchase_mdl,
		'time_options_mdl'         => $time_options_mdl,
    ]) ?>

</div>
