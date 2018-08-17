<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "access_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $access_date
 */
class AccessLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['access_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'access_date' => 'Access Date',
        ];
    }

    /**
     *
     * @param IdentityInterface $user
     * @return void
     */
    public static function add(IdentityInterface $user) {
        $model = new self();
        $model->user_id = $user->getId();
        $model->save();
    }
}
