<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name Название
 * @property string $start_at Начало
 * @property string $end_at Конец
 * @property string $created_at Создано
 * @property string $updated_at Обновлено
 * @property int $author_id
 * @property User $author
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at', 'created_at', 'updated_at', 'author_id'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'start_at' => 'Начало',
            'end_at' => 'Конец',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     *  @return ActiveQuery
     */
    public function getAuthor() {
        return $this->hasOne(User::class, ['id', 'author_id']);
    }
}
