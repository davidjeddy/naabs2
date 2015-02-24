<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
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
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
