<?php

namespace app\rbac;

use app\models\Access;
use yii\rbac\Rule;

class AccessEventRule extends Rule
{
    public $name = 'canViewEvent'; // Имя правила

    public function execute($user_id, $item, $params)
    {
        if(!isset($params['event'])) {
            return false;
        }
        return Access::find()->andWhere(['event_id' => $params['event']->id, 'user_id' => $user_id])->count();
    }
}