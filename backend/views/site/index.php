<?php
  cpn\chanpan\assets\jzoom\JZoomAsset::register($this); 
  use yii\helpers\Url;
  use yii\helpers\Html;

   cpn\chanpan\widgets\JZoom::widget([
      'src'=> Url::to('@web/img/bg1.jpg'),
      'options'=>[
          'width'=>'500',
          'height'=>'300',
          'type'=>'lens',
          'lensSize'=>500,
          'scrollZoom'=>true
      ]
  ]);
    
  
?>

<div class="row">
    <div class="col-md-10">
        <?php 
        echo \cpn\chanpan\widgets\JLightBox::widget([
            'image'=>[
                  ['src'=>Url::to('@web/img/bg1.jpg'), 'content'=>'image1', 'options'=>['width'=>'300']],
                  ['src'=>Url::to('@web/img/bg2.jpg'), 'content'=>'image2','options'=>['width'=>'300']],
                  ['src'=>Url::to('@web/img/bg3.jpg'), 'content'=>'image3','options'=>['width'=>'300']],
            ]    
        ]);
        
         cpn\chanpan\widgets\JSlide::widget([
                'image'=>[
                  ['src'=>Url::to('@web/img/bg1.jpg'), 'content'=>'image1'],
                  ['src'=>Url::to('@web/img/bg2.jpg'), 'content'=>'image2'],
                  ['src'=>Url::to('@web/img/bg3.jpg'), 'content'=>'image3'],
//                  ['src'=>Url::to('@web/img/bg4.jpg'), 'content'=>'image4'],
//                  ['src'=>Url::to('@web/img/bg5.jpg'), 'content'=>'image5'],
//                  ['src'=>Url::to('@web/img/bg6.jpg'), 'content'=>'image6'],
//                  ['src'=>Url::to('@web/img/bg7.jpg'), 'content'=>'image7'],
//                  ['src'=>Url::to('@web/img/bg8.jpg'), 'content'=>'image8'],
//                  ['src'=>Url::to('@web/img/bg9.jpg'), 'content'=>'image9'],
//                  ['src'=>Url::to('@web/img/bg1.jpg'), 'content'=>'image10'],
//                  ['src'=>Url::to('@web/img/bg2.jpg'), 'content'=>'image11'],
//                  ['src'=>Url::to('@web/img/bg3.jpg'), 'content'=>'image12'],
//                  ['src'=>Url::to('@web/img/bg4.jpg'), 'content'=>'image13'],
//                  ['src'=>Url::to('@web/img/bg5.jpg'), 'content'=>'image14'],
//                  ['src'=>Url::to('@web/img/bg6.jpg'), 'content'=>'image15'],
//                  ['src'=>Url::to('@web/img/bg7.jpg'), 'content'=>'image16'],
//                  ['src'=>Url::to('@web/img/bg8.jpg'), 'content'=>'image17'],
//                  ['src'=>Url::to('@web/img/bg9.jpg'), 'content'=>'image18'],
//                  ['src'=>Url::to('@web/img/bg1.jpg'), 'content'=>'image19'],
//                  ['src'=>Url::to('@web/img/bg2.jpg'), 'content'=>'image20']  
                ],
            ])
        ?>
    </div>
</div>