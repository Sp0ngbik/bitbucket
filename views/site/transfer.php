<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\LoginForm;
?>

<div class="site-login">
<?php $form = ActiveForm::begin(['fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
        ],]);?>

    <?= $form->field($model, 'currentUser')->textInput()->label('Username who will send')?>
    <?= $form->field($model, 'usernameSend')->textInput()->label('Username who will recive')?>
    <?= $form->field($model, 'valueToSend')->label('Value to send')?>
    <?= $form->field( $model, 'password')->passwordInput()->label('Password of sender username')?>
    <div class='form-group'>
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    <?php ActiveForm::end()?>
</div>
