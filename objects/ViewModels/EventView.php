<?php

namespace app\objects\ViewModels;

use app\models\Event;

class EventView
{
    /**
     * @param Event $event
     * @return bool
     */
    public function canWrite(Event $event): bool
    {
        return $event->author_id === \Yii::$app->getUser()->getId();
    }
}