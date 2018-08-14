<aside class="main-sidebar">

    <section class="sidebar">

        <?= \app\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Пользователи', 'icon' => 'users', 'url' => ['/admin/user']],
                    ['label' => 'Access', 'icon' => 'address-book', 'url' => ['/admin/access']],
                    ['label' => 'События', 'icon' => 'calendar ', 'url' => ['/admin/event']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
