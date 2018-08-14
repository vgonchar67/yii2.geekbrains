<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;

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
    public $updatable = false;

    public function afterFind()
    {
        $this->updatable = \Yii::$app->user->can('updateEvent', ['event' => $this]);
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => TimestampBehavior::class,
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
			],
		];
	}

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if (!$this->author_id) {
            $this->author_id = \Yii::$app->getUser()->getId();
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at', 'created_at', 'updated_at', 'author_id'], 'safe'],
            [['name'], 'required'],
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
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     *  @return ActiveQuery
     */
    public function getUsers(){
        return $this->hasMany(
            User::className(),
            ['id' => 'user_id']
        )->viaTable(
            'access',
            ['event_id' => 'id']
        );
    }

    public function getAccess(): ActiveQuery
    {
        return $this->hasOne(Access::class, ['event_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function isPast() {
        $date = new \DateTime($this->end_at);
        $currentDate = new \DateTime();
        return $currentDate > $date;
    }
}
