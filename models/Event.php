<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name Название
 * @property string $start_at Начало
 * @property string $end_at Конец
 * @property string $created_at Создано
 * @property string $updated_at Обновлено
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
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
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
}
