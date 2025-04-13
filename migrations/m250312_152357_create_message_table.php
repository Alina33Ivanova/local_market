<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m250312_152357_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'recipient_id' => $this->integer(),
            'text' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
        ]);
        $this->addForeignKey(
            'user_id_message_table_fk',
            '{{%message%}}',
            'user_id',
            '{{%user%}}',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message}}');
    }
}
