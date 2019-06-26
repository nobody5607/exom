<?php
use yii\helpers\Html;
use common\components\AppComponent;
use cpn\chanpan\widgets\CNMenu;
?>
<?php
    $moduleID = '';
    $controllerID = '';
    $actionID = '';

    if (isset(Yii::$app->controller->module->id)) {
        $moduleID = Yii::$app->controller->module->id;
    }
    if (isset(Yii::$app->controller->id)) {
        $controllerID = Yii::$app->controller->id;
    }
    if (isset(Yii::$app->controller->action->id)) {
        $actionID = Yii::$app->controller->action->id;
    }
 
    ?>
<?php 
 
    
?> 
<header class="main-header">

    <?= Html::a('<span class="logo-mini">EXDTA</span><span class="logo-lg">EXDTA</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-fixed-top" role="navigation"> 
    <div class="navbar-header">
      <?php echo AppComponent::slideToggleRight()?>  
      <?php echo AppComponent::slideToggleLeft()?>
        <a class="navbar-brand" href="#"><?= Yii::$app->name; ?></a>  
    </div>
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="cnNavbar">       
      
        <?php 
        echo yii\bootstrap\Nav::widget([
                'options'=>['class'=>'nav navbar-nav  navbar-right'],
                'items'=> AppComponent::menuRight(),
                'encodeLabels'=>FALSE
            ]);
     ?>  
     <?php 
        //echo '<div id="btnLanguage" class="navbar-text pull-right" >';
        //echo \lajax\languagepicker\widgets\LanguagePicker::widget([
        //    'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
        //    'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_SMALL
        //]);
            
        //echo '</div>';
        
     ?>   
      
   
        
    </div>
  </div>
    </nav>
</header>
<?php 
$this->registerCss("
 #leftMenu{position:fixed;}
 header.main-header .logo {
    position: fixed;
}
 @media screen and (max-width: 860px) {
    #iconslideToggle {
      float:right;
    }
    .skin-blue .main-header .logo{
        display:none;
    }
    #btnLanguage{
            text-align: center;
            width: 100%;
    }
  }
");
?>
