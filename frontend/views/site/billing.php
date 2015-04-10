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

    <p>User billing management.</p>

        <?php $form = ActiveForm::begin(['id' => 'user-billing']); ?>


            <div class="form-group">
                <?= Html::resetButton('Clear Form', 		['class' => 'btn btn-default', 'name' => 'billing-form-reset']) ?>
                <?= Html::submitButton('Submit Payment', 	['class' => 'btn btn-primary', 'name' => 'billing-form-submit']) ?>
            </div>
        <?php ActiveForm::end(); ?>
</div>
