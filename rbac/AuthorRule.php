<?php

namespace app\rbac;

use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor'; // Имя правила

    public function execute($user_id, $item, $params)
    {
        return isset($params['event']) ? $params['event']->author_id == $user_id && !$params['event']->isPast(): false;
    }
}