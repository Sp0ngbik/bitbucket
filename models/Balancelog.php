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
            [['username','username_send', 'balance_info','balance_recieve','id'], 'string'],
            [['time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'balance_info' => 'Balance Info',
            'time' => 'Time',
        ];
    }
}
