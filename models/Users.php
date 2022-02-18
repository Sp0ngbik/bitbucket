<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $acess_token
 * @property int $id
 */
class Users extends \yii\db\ActiveRecord
{
    public $newPassword;
    public $newPasswordConfirm;
    public $currentUser;
    public $usernameSend;
    public $valueToSend;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'usernameSend','valueToSend' ], 'required'],
            [['username', 'password', 'auth_key', 'acess_token',], 'string'],
            [['newPassword','newPasswordConfirm'],'string'],
            [['currentUser','usernameSend'],'string'],
            ['valueToSend','integer'],
            ['newPasswordConfirm','compare','compareAttribute'=>'newPassword','skipOnEmpty'=>false,
             'message'=>'New password must be equal to confirm new password.'],
            
        ];
    }
  
 
   
  
    /**
     * {@inheritdoc}
     */
  
  
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'id' => 'ID',
        ];
    }
}
