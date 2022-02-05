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
            [['username',  ], 'required'],
            [['username', 'password', 'auth_key', 'acess_token',], 'string'],
            [['newPassword','newPasswordConfirm'],'required'],
            [['newPassword','newPasswordConfirm'],'string'],
            [['newPasswordConfirm'],'compare','compareAttribute'=>'newPassword', 'message'=> 'Password do not match'],
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
