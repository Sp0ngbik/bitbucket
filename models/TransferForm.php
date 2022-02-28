<?php

namespace app\models;

use Yii;
use yii\base\Model;


class TransferForm extends Model
{
    private $_userSend = false;
    private $_userRecieve = false;
    public $currentUser;
    public $usernameSend;
    public $valueToSend;
    public $password;




    public function rules()
    {
        return [
            [['currentUser', 'usernameSend', 'password'], 'required', 'on' => 'fieldsUsername'],
            ['currentUser', 'validateCurrentUser'],
            ['usernameSend', 'validateUsernameSend'],
            ['valueToSend', 'integer'],
            ['valueToSend', 'required'],
        ];
    }

    public function validateCurrentUser()
    {
        $user = $this->getCurrentUser();
        $userWhoSend = $this->getUsernameSend();
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Incorrect password');
        } else if ($this->valueToSend > $user->balance) {
            $this->addError('valueToSend', 'Not enough balance');
        } else if ($this->valueToSend <= -1) {
            $this->addError('valueToSend', 'You cant transfer negative or null balance');
        }
    }

    public function validateUsernameSend()
    {
        $_userSend = $this->getCurrentUser();
        $_userRecieve = $this->getUsernameSend();
        if ($_userSend == $_userRecieve) {
            $this->addError('usernameSend', 'You cant transfer balance to yourself');
        }
    }

    public function getCurrentUser()
    {
        if ($this->_userRecieve === false) {
            $this->_userRecieve = NewUser::findByUsername($this->currentUser);
        }

        return $this->_userRecieve;
    }

    public function getUsernameSend()
    {
        if ($this->_userSend === false) {
            $this->_userSend = NewUser::findByUsername($this->usernameSend);
        }

        return $this->_userSend;
    }
}
