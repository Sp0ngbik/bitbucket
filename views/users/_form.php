<?php

// use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'password')->textarea(['rows' => 1]) ?>
    <?= $form->field($model, 'acess_token')->textarea(['rows' => 1]) ?>
     <?= $form->field($model, 'auth_key')->textarea(['rows' => 1]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success'])?>
       
 
    </div>

    <?php ActiveForm::end(); ?>

</div>
