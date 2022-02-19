
use app\models\LoginForm;
use app\models\NewUser;

?>

<div class="site-login">
<?php $form = ActiveForm::begin(['fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
        ],]);?>
     <?= $form->field($model, 'currentUser')->dropDownList(
    ArrayHelper::map(NewUser::find()->all(), 'username', 'username','balance',)
    )->label('Username that will send') ?>
      <?= $form->field($model, 'usernameSend')->dropDownList(
    ArrayHelper::map(NewUser::find()->all(), 'username', 'username','balance',)

     )->label('Username who will recieve') ?>
    <?= $form->field($model, 'valueToSend')->label('Value to send')?>
    <?= $form->field( $model, 'password')->passwordInput()->label('Password of sender username')?>
    <div class='form-group'>
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    <?php ActiveForm::end()?>
</div>

