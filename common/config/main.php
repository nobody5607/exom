<?php
return [
    'language'=>'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@cpn/chanpan' => '@common/lib/yii2-chanpan',
        '@cpn/admin' => '@common/lib/yii2-admin'
         
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Bangkok',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
           // 'class' =>  'yii\rbac\PhpManager',
            'class' =>  'yii\rbac\DbManager',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@backend/views' => '@backend/themes/admin/views',
                    //'@frontend/views' => '@frontend/themes/standard/views',
                    '@dektrium/user/views' => '@common/modules/user/views',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'fileMap' => [
                        'chanpan' => 'chanpan.php',
                    ],
                ],
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                ],
            ],
        ],
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '@storageUrl/source',
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@storage/web/source'
            ],
            'as log' => [
                'class' => 'backend\modules\core\behaviors\FileStorageLogBehavior',
                'component' => 'fileStorage'
            ]
        ],
        
        'moduleFileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '@storageUrl/module',
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@storage/web/module'
            ],
            'as log' => [
                'class' => 'backend\modules\core\behaviors\FileStorageLogBehavior',
                'component' => 'moduleFileStorage'
            ]
        ],
    ],
];
