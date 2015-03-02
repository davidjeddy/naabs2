<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\accountForm */

$this->title = 'account';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to account:</p>

    <code><?= __FILE__ ?></code>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-account']); ?>
                <!-- user_details TBO -->
                <?= $form->field($details, 'f_name') ?>
                <?= $form->field($details, 'l_name') ?>
                <?= $form->field($details, 'p_phone') ?>
                <?= $form->field($details, 'p_email') ?>
                <?= $form->field($details, 's_question') ?>
                <?= $form->field($details, 's_answer') ?>

                <!-- user TBO -->               
                <?= $form->field($model, 'username') ?>                
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('account', ['class' => 'btn btn-primary', 'name' => 'account-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
