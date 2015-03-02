<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $userDetails common\models\UserDetails */

$this->title = 'Update User Details: ' . ' ' . $userDetails->id;
$this->params['breadcrumbs'][] = ['label' => 'User Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $userDetails->id, 'url' => ['view', 'id' => $userDetails->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'form-userAccount']);?>
            <?= $form->field($userAccount, 'username') ?>                
            <?php //echo $form->field($userAccount, 'password')->passwordInput() ?>
            <?php //echo $form->field($userAccount, 'password_repeat')->passwordInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Update Account', ['class' => 'btn btn-primary', 'name' => 'account-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

	<hr />

    <?php $form = ActiveForm::begin(['id' => 'form-userDetails']); ?>
        <?= $form->field($userDetails, 'f_name') ?>
        <?= $form->field($userDetails, 'l_name') ?>
        <?= $form->field($userDetails, 'p_phone') ?>
        <?= $form->field($userDetails, 'p_email') ?>
        <?= $form->field($userDetails, 's_question') ?>
        <?= $form->field($userDetails, 's_answer') ?>
        <?= $form->field($userDetails, 'role') ?>
        <?= $form->field($userDetails, 'created_at') ?>
        <?= $form->field($userDetails, 'updated_at') ?>
        <?= $form->field($userDetails, 'deleted_at') ?>
        <div class="form-group">
            <?= Html::submitButton('Update Details', ['class' => 'btn btn-primary', 'name' => 'account-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
