<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop}}`.
 */
class m250303_151218_create_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'shop_name' => $this->string(256),
            'description' => $this->text(),
            'shop_image' => $this->string()->null(),
            'location' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'is_active' => $this->boolean()->defaultValue(0),
        ]);
        $this->addForeignKey(
            'user_id_shop_table_fk',
            '{{%shop%}}',
            'user_id',
            'user',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop}}');
    }
}
