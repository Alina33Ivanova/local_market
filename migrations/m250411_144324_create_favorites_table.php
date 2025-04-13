<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorites}}`.
 */
class m250411_144324_create_favorites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorites}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'shop_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'user_id_favorites_table_fk',
            '{{%favorites%}}',
            'user_id',
            '{{%user%}}',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'shop_id_favorites_table_fk',
            '{{%favorites%}}',
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
        $this->dropTable('{{%favorites}}');
    }
}
