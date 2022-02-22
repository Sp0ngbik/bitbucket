<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="site-login">

<?php foreach($arrayLog as $arrayLogs){
    echo ' Username : '.$arrayLogs->username.' Balance : '.$arrayLogs->balance_info. ' Time : ' . $arrayLogs->time . ' Reciever '.$arrayLogs->username_send . ' Balance '. $arrayLogs->balance_recieve.'<br />';
}
?>

</div>