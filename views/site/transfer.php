<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="site-login">
<?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'currentUser')->textInput()?>
    <?= $form->field($model, 'usernameSend')->textInput()?>
    <?= $form->field($model, 'valueToSend')?>
<!-- <?php if($model->scenario == 'fieldsUsername'):?>
    <?= $form->field( $model, 'password')->passwordInput()   ?>
    <?php endif; ?> -->
    <div class='form-group'>
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    <?php ActiveForm::end()?>
</div>
