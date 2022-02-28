<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Balancelog */

$this->title = $log->username;
$this->params['breadcrumbs'][] = ['label' => 'Balancelogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="balancelog-view">
<h1><?= Html::encode('Balance view of user ' .$this->title) ?></h1>
    <h3><?= Html::encode($log->username . ' sends')?></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username:ntext',
            'balance_info:ntext',
            'username_send:ntext',
            'balance_recieve:ntext',
            'time',
            [
                'class' => ActionColumn::className(),'template'=>'{view} {delete}'
                'urlCreator' => function ($action, 
                $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
<h3><?= Html::encode($log->username . ' recieves')?></h3>    
<?= GridView::widget([
    'dataProvider' => $dataProviderReciever,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'username:ntext',
        'balance_info:ntext',
        'username_send:ntext',
        'balance_recieve:ntext',
        'time',
        [
            'class' => ActionColumn::className(),'template'=>'{view} {delete}'
            'urlCreator' => function ($action, 
            $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>

</div>
</div>
