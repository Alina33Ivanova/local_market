<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250303_151137_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(256),
            'first_name' => $this->string(256),
            'last_name' => $this->string(256),
            'patronymic' => $this->string(256),
            'password' => $this->string(256),
            'phone_number' => $this->string(256),
            'email' => $this->string(256),
            'authKey' => $this->string(256),
            'created_at' => $this->timestamp(),
            'is_admin' => $this->boolean()->defaultValue(0),
            'is_seller' => $this->boolean()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
