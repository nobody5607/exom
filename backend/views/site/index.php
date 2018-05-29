<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<?php  echo Yii::t('backend','Home');?>
<div class="language-bar">
    <?php
    echo Html::a('th', Url::current(['language' => 'th-TH']), ['class' => (Yii::$app->request->cookies['language'] == 'th-TH' ? 'active' : '')]);
    echo " | ";
    echo Html::a('en', Url::current(['language' => 'en-US']), ['class' => (Yii::$app->request->cookies['language'] == 'en-US' ? 'active' : '')]);
    ?>
</div>
<?php 
        echo \cpn\chanpan\widgets\CNOrgChart::widget([
            'data' => [
                [['v' => 'Mike', 'f' => '<img style="width:180px;height:200px" src="http://www.majorcineplex.com/uploads/content/2551/skkltn.jpg" /><br  /> <strong>Mike</strong><br  />The President'], '', 'The President'],
                [['v' => 'Jim', 'f' => '<img style="width:180px;height:200px" src="http://www.majorcineplex.com/uploads/content/2551/skkltn.jpg" /><br  /><strong>Jim</strong><br  />The Test'], 'Mike', 'VP'],
                [['v' => 'ทดสอบ', 'f' => '<img style="width:180px;height:200px" src="http://www.majorcineplex.com/uploads/content/2551/skkltn.jpg" /><br  /><strong>ทดสอบ</strong><br  />The Test'], 'Mike', ''],
                [['v' => 'Caral', 'f' => '<img style="width:180px;height:200px" src="http://www.majorcineplex.com/uploads/content/2551/skkltn.jpg" /><br  /><strong>Caral</strong><br  />The Test'], 'Mike', 'Caral Title'],
                [['v' => 'Bob', 'f' => '<img style="width:180px;height:200px" src="http://www.majorcineplex.com/uploads/content/2551/skkltn.jpg" /><br  /><strong>Bob</strong><br  />The Test'], 'Jim', 'Bob Sponge'],
                [
                    [
                        'v' => 'Nut', 
                        'f' => '<img style="width:180px;height:200px" src="http://www.majorcineplex.com/uploads/content/2551/skkltn.jpg" /><br  /><strong>Nut</strong><br  />Chanpan'
                    ], 'Caral', 'Bob Sponge'],
            ]
        ]);
?>


<?php 
    echo \cpn\chanpan\widgets\CNModal::widget([
       'id' => 'modal-test',
        'size' => 'modal-lg',
        'tabindexEnable' => false,
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
    ]);
?>
<?php 
    $js="
        test=function(){
            let url = '".Url::to(['/site/test'])."';
            modalCoreField(url);    
        }
          
        function modalCoreField(url) {
            $('#modal-test .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
            $('#modal-test').modal('show')
            .find('.modal-content')
            .load(url);
        }
    ";
    $this->registerJs($js);
?>

 