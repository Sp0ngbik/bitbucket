<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="site-login">
<?php $form = ActiveForm::begin();?>
    <?= $form->field($model, 'currentUser')?>
    <?= $form->field($model, 'usernameSend')?>
    <?= $form->field($model, 'valueToSend')?>
    <div class='form-group'>
        <?= Html::submitButton('Save',['class'=>'btn btn-success'])?>
    </div>
    <?php ActiveForm::end()?>
</div>
