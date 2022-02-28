<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%balancelog}}".
 *
 * @property string $username
 * @property string $balance_info
 * @property string $time
 */
class Balancelog extends \yii\db\ActiveRecord
{
    public $current_date;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%balancelog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['username','username_send', 'balance_info', 'time'], 'required'],
            [['username', 'username_send', 'balance_info', 'balance_recieve', 'id'], 'string'],
            ['changing_value', 'integer'],
            [['time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->current_date = date("Y-m-d H:i:s");
    }
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Sender',
            'username_send' => 'Reciever',
            'balance_recieve' => 'Recieved balance',
            'balance_info' => 'Balance Info',
            'time' => 'Operation time',
        ];
    }
}
