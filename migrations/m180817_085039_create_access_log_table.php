<?php

use yii\db\Migration;

/**
 * Handles the creation of table `access_log`.
 */
class m180817_085039_create_access_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('access_log', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'access_date' => $this->dateTime()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('access_log');
    }
}
