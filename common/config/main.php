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
        'i18n' => [
            'translations' => [
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages', // if advanced application, set @frontend/messages
                    //'sourceLanguage' => 'en-US',
//                    'fileMap' => [
//                        'app' => 'app.php',
//                    ],
                ],
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                ],
            ],
        ],
    ],
];
