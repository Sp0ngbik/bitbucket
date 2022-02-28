<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BalancelogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Balancelogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balancelog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Balancelog', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username:ntext',
            'balance_info:ntext',
            'username_send:ntext',
            'balance_recieve:ntext',
            'time',
            [
                'class' => ActionColumn::className(),'template'=>'{view} {delete}',
                'urlCreator' => function ($action, 
                $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }  
            ],
        ],
    ]); ?>


</div>
