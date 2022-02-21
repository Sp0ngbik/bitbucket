<?php

namespace app\models;

use Yii;
use yii\base\Model;


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
        ['valueToSend','required'],
        ];
    }
   public function transferValidation($user,$userWhoSend){
   if(
       !password_verify($this->password,$user->password)
   ){
     $this->addError('password','Incorrect password');
    }else if($this->valueToSend > $user->balance){
        $this->addError('valueToSend','Not enough balance');;
    }else if($user==$userWhoSend){
        $this->addError('usernameSend','You cant transfer balance to yourself');
    }else if($this->valueToSend<=-1){
        $this->addError('valueToSend','You cant transfer negative or null balance');
    }
   }
}

