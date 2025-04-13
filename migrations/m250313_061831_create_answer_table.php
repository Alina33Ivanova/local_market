<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer}}`.
 */
class m250313_061831_create_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'sender_id' => $this->integer(),
            'text' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
        ]);
        $this->addForeignKey(
            'user_id_answer_table_fk',
            '{{%answer%}}',
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
        $this->dropTable('{{%answer}}');
    }
}
