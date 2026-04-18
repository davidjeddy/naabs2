<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>
<div class="form-group pull-right">
    <?= Html::resetButton('Reset',   ['class' => 'btn btn-default']) ?>
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    <?php /*<?= Html::submitButton($purchase_mdl->isNewRecord ? 'Create' : 'Update',
        ['class' => $purchase_mdl->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>*/ ?>
</div>