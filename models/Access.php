<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\filters\AccessControl;

/**
 * This is the model class for table "access".
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property User $user
 * @property Event $event
 */
class Access extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id'], 'required'],
            [['event_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getEvent() {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }

    public static function saveAccess(Event $event, int $userId): void
    {
        $access = new self();
        $access->setAttributes([
            'event_id' => $event->id,
            'user_id' => $userId,
        ]);
        $access->save();
    }
}
