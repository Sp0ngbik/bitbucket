<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Update Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
 <?php $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password)?>   
<?php $model->auth_key= md5(random_bytes(5));?>
<?php $model->acess_token = password_hash(random_bytes(10),PASSWORD_DEFAULT);?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
