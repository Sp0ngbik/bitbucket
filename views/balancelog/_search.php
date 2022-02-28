<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BalancelogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="balancelog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id') ?> -->

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'username_send') ?>

    <?= $form->field($model, 'balance_recieve') ?>

    <?= $form->field($model, 'balance_info') ?>

    <?php // echo $form->field($model, 'time') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>