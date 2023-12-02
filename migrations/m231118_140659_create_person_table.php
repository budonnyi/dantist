<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m231118_140659_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'first_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'last_name' => $this->string()->notNull(),
            'birth_day' => $this->date()->notNull(),
            'birth_country' => $this->string()->notNull(),
            'birth_area' => $this->string(),
            'birth_city' => $this->string()->notNull(),
            'location_country' => $this->string(),
            'location_area' => $this->string(),
            'location_city' => $this->string(),
            'location_address' => $this->string(),
            'comment' => $this->text(),
            'phone' => $this->string(),
            'email' => $this->string()->unique(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person}}');
    }
}
