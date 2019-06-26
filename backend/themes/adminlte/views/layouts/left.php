<aside class="main-sidebar" id="leftMenu">

    <section class="sidebar">
 

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'หน้าแรก', 'icon' => 'home', 'url' => ['/'],'visible' => Yii::$app->user->isGuest],
                    ['label' => 'เกี่ยวกับโครงการ', 'icon' => 'flask', 'url' => ['/site/about'],'visible' => Yii::$app->user->isGuest ],
                    ['label' => 'ติดต่อเรา', 'icon' => 'dashboard', 'url' => ['/site/contact'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'จัดการข้อมูลคลีนิก', 'icon' => 'dashboard', 'url' => ['/clinical-data-management'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => Yii::t('appmenu','Member Management'), 'icon' => 'users', 'url' => ['/user/admin/index'], 'visible' => !Yii::$app->user->isGuest],
                    

                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'visible' => !Yii::$app->user->isGuest,
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    
                    [
                        'visible' => !Yii::$app->user->isGuest,
                        'label' => Yii::t('appmenu', 'System Config'),
                        'icon' => 'cog',
                        'url' => '#',
                        'items' => [
                            //['label' => 'Authentication', 'icon' => 'cogs', 'url' => ['/admin/role/view?id=admin'],],
                            
                            [
                                'label' => Yii::t('appmenu', 'Authentication'),
                                'icon' => 'cogs',
                                'url' => '#',
                                'items' => [
                                    //Assignments
                                    ['label' => Yii::t('appmenu', 'Assignments'), 'icon' => 'circle-o', 'url' => ['/admin'],],
                                    ['label' => Yii::t('appmenu', 'Role'), 'icon' => 'circle-o', 'url' => ['/admin/role'],],
                                    ['label' => Yii::t('appmenu', 'Route'), 'icon' => 'circle-o', 'url' => ['/admin/route'],],
                                    ['label' => Yii::t('appmenu', 'Permission'), 'icon' => 'circle-o', 'url' => ['/admin/permission'],],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
