<?php

use yii\db\Migration;


/**
 * Class m180814_054135_add_rbac_roles
 */
class m180814_054135_add_init_rbac_roles extends Migration
{
    public function getAdmin() {
        $admin = \app\models\User::findByUsername('admin');
        if(!$admin) {
            $admin = new \app\models\User();
            $admin->setAttributes([
                'username' => 'admin',
                'password' => 'admin',
            ]);

            if(!$admin->save()) {
                return false;
            }
        }
        return $admin;
    }

    public function setUsers() {
        $users = \app\models\User::find()->all();
        foreach ($users as $user) {
            $userRole = \Yii::$app->authManager->getRole('user');
            \Yii::$app->authManager->assign($userRole, $user->getId());
        }
    }

    public function setAdminRole(\app\models\User $user) {
        $userRole = \Yii::$app->authManager->getRole('admin');
        \Yii::$app->authManager->assign($userRole, $user->getId());
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = \Yii::$app->authManager;
        $role = $auth->createRole('admin');
        $role->description = 'Администратор';
        $auth->add($role);

        $role = $auth->createRole('user');
        $role->description = 'Пользователь';
        $auth->add($role);

        $this->setUsers();
        $this->setAdminRole($this->getAdmin());

        $permit = $auth->createPermission('updateEvent');
        $permit->description = 'Право на редактирование события';
        $auth->add($permit);

        // добовляем правило
        $isAuthorRule = new \app\rbac\AuthorRule();
        $auth->add($isAuthorRule);

        // добавляем право "updateOwnEvent" и связываем правило с ним
        $updateOwnEvent = $auth->createPermission('updateOwnEvent');
        $updateOwnEvent->description = 'Редактировать события';
        $updateOwnEvent->ruleName = $isAuthorRule->name;
        $auth->add($updateOwnEvent);

        // "updateOwnEvent" наследует право "updateEvent"
        $updateEvent = $auth->getPermission('updateEvent');
        $auth->addChild($updateOwnEvent, $updateEvent);

        $user = $auth->getRole('user');
        // и тут мы позволяем автору редактировать свои события
        $auth->addChild($user, $updateOwnEvent);

        $admin = $auth->getRole('admin');
        // и тут мы позволяем автору редактировать свои события
        $auth->addChild($admin, $updateEvent);

        // canViewEvent
        $viewEvent = $auth->createPermission('viewEvent');
        $auth->add($viewEvent);


        // canViewEventAccess
        $canViewRule = new \app\rbac\AccessEventRule();
        $auth->add($canViewRule);
        $viewAccessEvent = $auth->createPermission('viewAccessEvent');
        $viewAccessEvent->ruleName = $canViewRule->name;
        $auth->add($viewAccessEvent);


        $auth->addChild($viewAccessEvent, $viewEvent);

        $auth->addChild($admin, $viewEvent);
        $auth->addChild($user, $viewAccessEvent);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        \Yii::$app->authManager->removeAllRoles();
        \Yii::$app->authManager->removeAllRules();
        \Yii::$app->authManager->removeAllPermissions();
        \Yii::$app->authManager->removeAllAssignments();

    }

}
