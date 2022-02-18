<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\NewUser;

class TransferForm extends Model
{
    public $currentUser;
    public $usernameSend;
    public $valueToSend;
    public $password;
    
public function rules(){
    return [
        [['currentUser','usernameSend','password'],'required','on'=>'fieldsUsername'],
        ['valueToSend','integer'],
    ];
}
public function trasferValidation (){
    $this->scenario = 'fieldsUsername';
    if($this->load(Yii::$app->request->post())){
        $currentUsername = NewUser::findByUsername($this->currentUser);
        $userSend = NewUser::findByUsername($this->usernameSend);
        if(!$currentUsername){
            $this->addError('currentUser','No username found');
        } else if(password_verify($this->password,$currentUsername->password)){
             if(!$userSend){
            $this->addError('usernameSend','No username found');
        }  else if($this->valueToSend > $currentUsername->balance){
            $this->addError('valueToSend','Not enough balance'); 
        }else if($currentUsername==$userSend){
            $this->addError('usernameSend','You cant transfer balance to yourself');
        }else if($this->valueToSend<=-1){
           $this->addError('valueToSend','You cant transfer negative or null balance');
        }else if(
            !$this->hasErrors()
        ){  
            $currentUsername->balance -=  $this->valueToSend;
            $currentUsername->update();
            $userSend->balance +=  $this->valueToSend;
            $userSend->update();
        }}else{
            $this->addError('password','Incorrect password');
        }
      
        
    }
}
}
