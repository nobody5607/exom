<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinicaldata */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="clinicaldata-form">

    <?php $form = ActiveForm::begin([
	'id'=>$model->formName(),
    ]); ?>

    <div class="modal-header" style="background: #3c8dbc;color: #fff;">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="itemModalLabel"><i class="fa fa-table"></i> Clinicaldata</h4>
    </div>

    <div class="modal-body">
	<?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'sex')->textInput() ?>

	<?= $form->field($model, 'age')->textInput() ?>

	<?= $form->field($model, 'birthdate')->textInput() ?>

	<?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    </div>
    <div class="modal-footer" style="background: #f3f3f3;">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
	 
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('form#<?= $model->formName()?>').on('beforeSubmit', function(e) {
    var $form = $(this);
    $.post(
        $form.attr('action'), //serialize Yii2 form
        $form.serialize()
    ).done(function(result) {
        if(result.status == 'success') {
            <?= SDNoty::show('result.message', 'result.status')?>
            if(result.action == 'create') {
                //$(\$form).trigger('reset');
                $(document).find('#modal-clinicaldata').modal('hide');
                $.pjax.reload({container:'#clinicaldata-grid-pjax'});
            } else if(result.action == 'update') {
                $(document).find('#modal-clinicaldata').modal('hide');
                $.pjax.reload({container:'#clinicaldata-grid-pjax'});
            }
        } else {
            <?= SDNoty::show('result.message', 'result.status')?>
        } 
    }).fail(function() {
        <?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>
        console.log('server error');
    });
    return false;
});
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>