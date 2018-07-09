<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\cpn\chanpan\assets\bootbox\BootBoxAsset::register($this);
\cpn\chanpan\assets\notify\NotifyAsset::register($this);
\cpn\chanpan\assets\jrating\JRatingAsset::register($this);
\cpn\chanpan\assets\mdi\MDIAsset::register($this);  
cpn\chanpan\assets\jquery_scroll\JqueryScrollAsset::register($this);
// \cpn\chanpan\assets\footable\FooTableAsset::register($this);


?>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    .modal-content{
        position: relative;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 6px;
        outline: 0;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
    }
    .modal-header {
        border-bottom-color: #c9c9c9;
        background: #eaeaea;
        border-top-left-radius: 5px;
        padding: 10px;
        border-bottom: 1px solid #c0bdbd;
        border-top-right-radius: 5px;
    } 
    .modal-md {
        width: 70%;
    }

     
</style>
<?php appxq\sdii\widgets\CSSRegister::end();?>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $("body").niceScroll({        
        cursorcolor:"#949b99",
        cursorwidth:"7px",
        cursorborder: "1px solid #949b99", // css definition for cursor border
        cursorborderradius: "5px",
        railpadding: { top: 50, right: 3, left: 0, bottom: 0 },         
        autohidemode:false,         
    });

</script>
<?php \richardfan\widget\JSRegister::end();?>
<?php
// if (Yii::$app->controller->action->id === 'login') { 
 
//     echo $this->render(
//         'main',
//         ['content' => $content]
//     );
// } else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    \backend\themes\adminlte\assets\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        
        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?> 
         
        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
        
    </div>
        <?= \bluezed\scrollTop\ScrollTop::widget() ?>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php  // } ?>
