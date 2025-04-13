<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m250311_060128_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(256),
            'last_name' => $this->string(256),
            'phone_number' => $this->string(256),
            'product_id' => $this->integer(),
            'take' => $this->boolean()->defaultValue(0),
            'delivery_address' => $this->boolean()->defaultValue(0),
            'street' => $this->string(256),
            'settlement' => $this->string(256),
            'house' => $this->string(256),
            'flat' => $this->string(256),
            'pay' =>  $this->boolean()->defaultValue(0),
            'payment' => $this->boolean()->defaultValue(0),
            'card_number' => $this->string(256),
            'cvv' => $this->string(256),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey(
            'product_id_order_table_fk',
            '{{%order%}}',
            'product_id',
            'product',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
