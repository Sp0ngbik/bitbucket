<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220202_164658_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username'=> $this->string(),
            'password'=> $this->string(),
            'login_counter'=>$this->primaryKey(),
            'acess_token' => $this->string(),
            'auth_key' => $this->string(),
        ]);
        $this->createTable('{{%balancelog}}',[
            'username'=>$this->string(),
            'balance_info'=>$this->string(),
            'time'=>$this->string(),
            'changing_value'=>$this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
        $this->dropTable('{{%balancelog}}');
    }
}
