<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\accountForm */

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to account:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <!-- user TBO -->               
                <?= $form->field($model, 'username') ?>                
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                <hr />

                <!-- user_details TBO -->
                <?= $form->field($details, 'f_name') ?>
                <?= $form->field($details, 'l_name') ?>
                <?= $form->field($details, 'p_phone') ?>
                <?= $form->field($details, 'p_email') ?>
                <?= $form->field($details, 's_question') ?>
                <?= $form->field($details, 's_answer') ?>
                <div class="form-group">
                    <?= Html::submitButton('Create Account', ['class' => 'btn btn-primary', 'name' => 'account-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php if (YII_DEBUG) { //pre-populate form when testing ?>
<script>
// jQuery is loaded after the page completes, wait for Window.onload to be valid.   
window.onload=function(){
    $("#signupform-username").val('UserUsername');
    $("#signupform-password").val('useruser');
    $("#signupform-password_repeat").val('useruser');

    $("#userdetails-f_name").val('UserFName');
    $("#userdetails-l_name").val('UserLName');
    $("#userdetails-p_phone").val('1234567890');
    $("#userdetails-p_email").val('user@user.com');
    $("#userdetails-s_question").val('who am i');
    $("#userdetails-s_answer").val('a user');
};
</script>
<?php } ?>