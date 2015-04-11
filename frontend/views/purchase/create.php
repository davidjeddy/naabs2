<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $purchase_mdl frontend\models\Purchase */

$this->title = 'Billing';
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="purchase-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_purchase', [
		'cc_format_mdl' => $cc_format_mdl,
		'purchase_mdl'  => $purchase_mdl,
    ]) ?>

</div>
