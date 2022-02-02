<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
  
        <?= Yii::$app->user->isGuest ?null:Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Yii::$app->user->isGuest ?null:Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $model->password=Yii::$app->getSecurity()->generatePasswordHash($model->password)?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username:ntext',
            'password:ntext',
            'acess_token:ntext',
            'auth_key:ntext',
            
        ],
    ]) ?>

</div>
