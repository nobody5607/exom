<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Profile $profile
 */
?>
 
<?php $form = ActiveForm::begin([
    'id'=>$profile->formName(),
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa fa-user"></i> <?= Yii::t('chanpan','Update Member')?></h4>
</div>
<div class="modal-body">
    <?= $form->field($profile, 'firstname') ?>
    <?= $form->field($profile, 'lastname') ?>
    <?= $form->field($profile, 'public_email')->label(Yii::t('chanpan','Public Email')) ?>
    <?= $form->field($profile, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '9999999999',
    ]) ?>
    <?= $form->field($profile, 'bio')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '99/99/9999',
    ]) ?>
    <?php
        echo $form->field($profile, 'image')->widget(\trntv\filekit\widget\Upload::classname(), [
            'url' => ['/core/file-storage/avatar-upload'],
            'id'=>'image-profile'
        ])
    ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
            <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
<?php \richardfan\widget\JSRegister::begin(); ?>
<script>
     $('form#<?= $profile->formName()?>').on("beforeSubmit", function(){
        let frm = $(this);
        let url = frm.attr('action');
        
        $.post(url, frm.serialize()).done(function(result){
            <?= cpn\chanpan\helpers\CNNoty::show('result.message', 'result.status')?>
        });
        return false;
     });
</script>
<?php \richardfan\widget\JSRegister::end();?>

 
