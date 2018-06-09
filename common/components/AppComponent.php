<?php
 
namespace common\components;
use Yii; 
use yii\helpers\Url;
class AppComponent {
    public static function menuLeft($moduleID, $controllerID, $actionID){
        $items = [
            ['label' => 'Home', 'url' => ['/'],'active' => ($controllerID == 'site' && $actionID == 'index')],
            ['label' => 'About', 'url' => ['site/about']],
            ['label' => 'Contect', 'url' => ['site/contact']],
            [
            'label' => 'Dropdown','active'=>true,
                'items' => [
                     ['label' => 'Level 1 - Dropdown A', 'url' => '#','active'=>true],
                     '<li class="divider"></li>',
                     '<li class="dropdown-header">Dropdown Header</li>',
                     ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                ],
            ],
        ];
        return $items;
    }
    public static function menuRight(){
        
        $items = [            
            [
                'label' => isset(Yii::$app->user->identity->profile->name) ? Yii::$app->user->identity->profile->name : '',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                     ['label' => '<i class="fa fa-user"></i> '.Yii::t('chanpan','User Profile'), 'url' => ['/user/settings/profile']],
                     '<li class="divider"></li>', 
                     ['label' => '<i class="fa fa-sign-out"></i> '.Yii::t('chanpan','Logout'), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ],
            ['label' => "<i class='fa fa-sign-in'></i> ".Yii::t('backend','Sign up'), 'url' => ['/user/register'], 'visible' => Yii::$app->user->isGuest],
            ['label' => "<i class='fa fa-sign-in'></i> ".Yii::t('backend','Login'), 'url' => ['/user/login'], 'visible' => Yii::$app->user->isGuest],
        ];
        return $items;
    }
    public static function subMenu(){
        $items = [
            ['label' => 'Home', 'url' => ['site/index']],             
            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
        ];
        return $items;
    }
    public static function slideToggleLeft(){              
        return \yii\helpers\Html::a("<span class='sr-only'></span>", '#', [
            'class'=>'sidebar-toggle',
            'data-toggle'=>'push-menu',
            'role'=>'button',
            'id'=>'iconslideToggle'
        ]);
    }
    public static function slideToggleRight(){  
        return 
        
        \yii\helpers\Html::button("<i class='fa fa-bars'></i>", [
            'class'=>'navbar-toggle',
            'data-toggle'=>'collapse',
            'data-target'=>'#cnNavbar',
            
        ]);
         
    }
}
