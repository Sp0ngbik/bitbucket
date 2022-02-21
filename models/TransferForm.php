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

}

