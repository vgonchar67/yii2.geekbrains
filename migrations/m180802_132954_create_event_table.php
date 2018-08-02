<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 */
class m180802_132954_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->comment('Название'),
            'start_at' => $this->date()->comment('Начало'),
            'end_at' => $this->date()->comment('Конец'),
            'created_at' => $this->dateTime()->defaultExpression('NOW()')->comment('Создано'),
            'updated_at' => $this->dateTime()->defaultExpression('NOW()')->comment('Обновлено'),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('event');
    }
}
