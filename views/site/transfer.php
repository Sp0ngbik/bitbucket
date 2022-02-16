<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="site-login">
<?php $form = ActiveForm::begin();?>
    <?= $form->field($db, 'username')?>
    <?= $form->field($db, 'usernameSend')?>
    <?= $form->field($db, 'valueToSend')?>
    <div class='form-group'>
        <?= Html::submitButton('Save',['class'=>'btn btn-success'])?>
    </div>
    <?php ActiveForm::end()?>
</div>
