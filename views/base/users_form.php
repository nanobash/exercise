<?php

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;

?>

<div class="content__user__createUpdate">

    <?php
    if (true === $update) {
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'firstName') ?>
    <?= $form->field($user, 'lastName') ?>
    <?= $form->field($user, 'email') ?>
    <?= $form->field($user, 'personalCode') ?>
    <?= $form->field($user, 'phone') ?>
    <?= $form->field($user, 'active') ?>
    <?= $form->field($user, 'isDead') ?>
    <?= $form->field($user, 'lang') ?>

    <div class="form-group">
        <?= Html::submitButton('Create/Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    } else { // else block of delete template
    ?>

    <?php $form = ActiveForm::begin(); ?>

        <strong class="text-center">Are you sure want to delete user with the ID of <?= $userId; ?> ?</strong>

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
