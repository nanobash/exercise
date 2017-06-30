<?php

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;

?>

<div class="content__loan__createUpdate">

    <?php
    if (true === $update) {
        ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($loan, 'loanId') ?>
        <?= $form->field($loan, 'userId') ?>
        <?= $form->field($loan, 'amount') ?>
        <?= $form->field($loan, 'interest') ?>
        <?= $form->field($loan, 'duration') ?>
        <?= $form->field($loan, 'dateApplied') ?>
        <?= $form->field($loan, 'dateLoanEnds') ?>
        <?= $form->field($loan, 'campaign') ?>
        <?= $form->field($loan, 'status') ?>

        <div class="form-group">
            <?= Html::submitButton('Create/Update', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php
    } else { // else block of delete template
        ?>

        <?php $form = ActiveForm::begin(); ?>

        <strong class="text-center">Are you sure want to delete loan with the ID of <?= $loanId; ?> ?</strong>

        <hr>

        <div class="form-group">
            <?= Html::submitButton('Delete', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php } ?>

    <!-- Notifications goes below -->

    <?php
    if (1 === $success) {
        echo <<<HTML
<div class="alert alert-success">
    <strong>Operation Succeeded!</strong>
</div>
HTML;
    } elseif (2 === $success) {
        echo <<<HTML
<div class="alert alert-danger">
    <strong>Operation Failed!</strong>
</div>
HTML;
    }
    ?>
</div>
