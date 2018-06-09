<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log',
            [
            'class' => 'common\components\LanguageSelector',
            'supportedLanguages' => ['en-US', 'th-TH'], //กำหนดรายการภาษาที่ support หรือใช้ได้
            ]
    ],
     
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/themes/adminlte/views'
                ]
            ]
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                       '<controller:\w+>/<id:\d+>' => '<controller>/view',
                       '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                       '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                       ['class' => 'yii\rest\UrlRule', 'controller' => 'location', 'except' => ['delete','GET', 'HEAD','POST','OPTIONS'], 'pluralize'=>false],
                       '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
        
        'languagepicker' => [
            'class' => 'lajax\languagepicker\Component',
            'languages' => ['en-US', 'th-TH'], // List of available languages (icons only)
            'cookieName' => 'language', // Name of the cookie.
            'expireDays' => 64, // The expiration time of the cookie is 64 days.
            'callback' => function() {
                if (!\Yii::$app->user->isGuest) {
                    //		    $user = \Yii::$app->user->identity;
                    //		    $user->language = \Yii::$app->language;
                    //		    $user->save();
                }
            }
        ],
 
         
    ],
    'modules'=>[
         'gridview' =>  [
                'class' => '\kartik\grid\Module'
        ],
        'core' => [
            'class' => 'backend\modules\core\Module',
        ],
        'admin' => [
             'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'cpn\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User', 
                ]
            ],
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],//admin
            'modelMap' => [
                'User' => 'common\modules\user\models\User',
                'Profile' => 'common\modules\user\models\Profile',
                'RegistrationForm' => 'common\modules\user\models\RegistrationForm',
                'UserSearch'=>'common\modules\user\models\UserSearch'
            ],
            'controllerMap' => [
                'admin' => 'common\modules\user\controllers\AdminController',
                'settings' => 'common\modules\user\controllers\SettingsController',
                'registration' => 'common\modules\user\controllers\RegistrationController',
                'security'=>'common\modules\user\controllers\SecurityController',
            ],
        ],
        
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //module, controller, action ที่อนุญาตให้ทำงานโดยไม่ต้องผ่านการตรวจสอบสิทธิ์
            'site/*',
            //'admin/*',
        ]
    ],
    'params' => $params,
];
