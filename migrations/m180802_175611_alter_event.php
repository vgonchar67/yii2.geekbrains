<?php

use app\models\Event;
use yii\db\Migration;

/**
 * Class m180802_175611_alter_event
 */
class m180802_175611_alter_event extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Event::tableName(), 'author_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Event::tableName(), 'author_id');
    }

}
