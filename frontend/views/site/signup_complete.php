<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Naabs 2';

$userData = \common\models\UserDetails::find()->andWhere(['user_id' => \Yii::$app->user->getIdentity()->id])->one();
$username = \common\models\User::find()->andWhere(['id' => \Yii::$app->user->getIdentity()->id])->one()->username;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Naabs 2</h1>
        <p class="lead"></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-12">
                <h2 class="center">Account Creation was a success!</h2>
                <p></p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h4 class="center">You are Almost Done</h4>
                <p></p>
            </div>
        </div>
    

It is very important to keep the information you used to create this account. We recommend that you write it down and save it somewhere in a safe place. Even if you call us we will need ask you this information for security purposes.

<p>Username: <?= $username; ?></p>
<p>Security Question: <?= $userData->s_question; ?></p>
<p>Security Answer: <?= $userData->s_answer; ?></p>

<p>&nbsp;</p>
<p><strong>Remember</strong> your username is for logging into the portal for internet, and the account management page.</p>

<p>Now that your account has been created you must add a block of time to your account before you can go online. To add time please go to the Purchase Page.</p>

<?= Html::a('Purchase Access Time', ['purchase/create'], ['class' => 'btn btn-success']) ?>

    </div>
</div>
