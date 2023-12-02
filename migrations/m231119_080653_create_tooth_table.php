<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tooth}}`.
 */
class m231119_080653_create_tooth_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tooth}}', [
            'id' => $this->primaryKey(),
            'card_id' => $this->integer()->notNull(),
            'tooth' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tooth}}');
    }
}
