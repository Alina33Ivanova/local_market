<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m250303_151257_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(),
            'image' => $this->string()->null(),
            'title' => $this->string(256),
            'description' => $this->string(256),
            'price' => $this->string(256),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'is_active' => $this->boolean()->defaultValue(0),
        ]);
        $this->addForeignKey(
            'shop_id_product_table_fk',
            '{{%product%}}',
            'shop_id',
            '{{%shop%}}',
            'id',
            'CASCADE',
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
