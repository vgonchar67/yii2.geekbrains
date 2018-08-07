<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.08.18
 * Time: 16:27
 */

namespace app\objects\ViewModels;


use app\models\Event;
use app\models\User;

class AccessCreateView
{
    /**
     * @return array
     */
    public function getEventOptions () {
        return Event::find()->indexBy('id')->select('name')->column();
    }

    /**
     * @return array
     */
    public function getUserOptions () {
        return User::find()->indexBy('id')->select('username')->column();
    }
}