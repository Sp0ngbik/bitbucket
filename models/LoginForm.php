<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;
    public $verifyCode;
    private $_user = false;
    public $login_counter;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword',],
            // ['login_counter','string'],
            //added captcha here for rules , from users
            ['verifyCode', 'captcha','on'=>'withCaptcha',],
           
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            $db= NewUser::findByUsername($this->username);
         
            if (!$user || !$user->validatePassword($this->password)) {
                if(!$user){
                    $this->addError($attribute,'No user found');
                }else {
                    $db->login_counter = $db->login_counter +1;
                    $db->update();
                    $this->addError($attribute, 'Incorrect username or password.');            
                }
            }else{
                $db->login_counter=0;
                $db->update();
            }
        
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */

    public function login()
    {
        $db= NewUser::findByUsername($this->username);
       
        if ($this->validate()) {
           if($db->login_counter >=3 ){
               $this->scenario = 'withCaptcha';
           }else{

               return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
           }
        }else if($db->login_counter >=3 ){
            $this->scenario = 'withCaptcha';

        }

        
        return false;
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = NewUser::findByUsername($this->username);
            
        }

        return $this->_user;
    }
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
}
