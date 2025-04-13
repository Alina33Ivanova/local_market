<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application}}`.
 */
class m250303_114043_create_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(256),
            'name_shop' => $this->string(256),
            'description' => $this->text(),
            'resume' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%application}}');
    }
}
