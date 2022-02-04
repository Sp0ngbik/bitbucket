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
            // [['username', 'password', 'auth_key', 'acess_token',], 'required'],
            [['username', 'password', ], 'required'],
            [['username', 'password', 'auth_key', 'acess_token',], 'string'],
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
