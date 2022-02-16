<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="site-login">
<?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'currentUser')->textInput()?>
    <?= $form->field($model, 'usernameSend')->textInput()?>
    <?= $form->field($model, 'valueToSend')?>

    <div class='form-group'>
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    <?php ActiveForm::end()?>
</div>
