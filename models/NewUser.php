<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property string $name
 * @property string $password
 * @property string $auth_key
 * @property string $acess_token
 * @property int $id
 */
class NewUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
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
            [['username', ], 'required'],
            [['password', 'auth_key', 'acess_token',], 'string'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Name',
            'password' => 'Password',
        ];
    }
    
    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type=null){
        return self::findOne(['acess_token'=>$token]);

    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);

    }

    public function getId(){
        return $this->id;
    }
    public function getAuthKey(){
        return $this->auth_key;
    }
 
    public function validateAuthKey($auth_key){
        return $this->auth_key === $auth_key;
    }

    public function validatePassword($password){
        return password_verify($password, $this->password);
    }
}
