<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class User
 * @package app\models
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $access_token
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName() {

        return 'user';
    }

    public function rules() {
        return [
            [['username', 'password'], 'required']
        ];
    }

    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)) {
            return false;
        }

        if($this->getIsNewRecord() && $this->password) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        if(!$this->access_token) {
            $this->access_token = Yii::$app->security->generateRandomString();
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->access_token;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->access_token === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
