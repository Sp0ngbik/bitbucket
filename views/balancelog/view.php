<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Balancelog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Balancelogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="balancelog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach($arrayLog as $arrayLogs){
    echo ' Username : '.$arrayLogs->username.' ,Balance : '.$arrayLogs->balance_info.','.'<br />' . 
    ' Reciever : '.$arrayLogs->username_send . ' ,Balance : '. $arrayLogs->balance_recieve.','.
    '<br />'. ' Time : ' . $arrayLogs->time .';'.'<br/>'. ' ' . '<br/> ';
}
?>    
 

</div>
