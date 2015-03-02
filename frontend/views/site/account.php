<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\accountForm */

$this->title = 'Account';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Update your account information here:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-account']); ?>

                <?= $form->field($details, 'id')->hiddenInput()->label(false) ?>
                <?= $form->field($details, 'user_id')->hiddenInput()->label(false) ?>
                <?= $form->field($details, 'f_name') ?>
                <?= $form->field($details, 'l_name') ?>
                <?= $form->field($details, 'p_phone') ?>
                <?= $form->field($details, 's_phone') ?>
                <?= $form->field($details, 't_phone') ?>
                <?= $form->field($details, 'p_email') ?>
                <?= $form->field($details, 's_email') ?>
                <?= $form->field($details, 's_question') ?>
                <?= $form->field($details, 's_answer') ?>

                <div style="color:#999;margin:1em 0">
                    <?= Html::a('Reset password', ['site/request-password-reset']) ?>.
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Update Account',
                        ['class' => 'btn btn-primary', 'name' => 'account-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
