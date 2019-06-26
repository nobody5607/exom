<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml; 

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Clinicaldata */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clinicaldatas');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">
    <div class="box-header">
         <i class="fa fa-table"></i> <?=  Html::encode($this->title) ?> 
         <div class="pull-right">
            
             <?php 
                if(\Yii::$app->user->can('admin') || \Yii::$app->user->can('clinical_data_management') || \Yii::$app->user->can('researcher')){
                    echo Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['/clinical-data-management/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-clinicaldata']);
                    echo ' ';
                }
                if(\Yii::$app->user->can('admin') || \Yii::$app->user->can('clinical_data_management')){
		            echo Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['/clinical-data-management/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-clinicaldata', 'disabled'=>true]); 
                }
             ?>
            
         </div>
    </div>
<div class="box-body">    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'clinicaldata-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'clinicaldata-grid',
/*	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['clinicaldata/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-clinicaldata']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['clinicaldata/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-clinicaldata', 'disabled'=>true]),*/
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionClinicaldatumIds'
		],
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:40px;text-align: center;'],
	    ],
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],

           // 'id',
            'hn',
            'firstname',
            'lastname',
            'sex',
             'age',
             'birthdate',
             'address:ntext',

	    [
		'class' => 'appxq\sdii\widgets\ActionColumn',
		'contentOptions' => ['style'=>'width:180px;text-align: center;'],
		'template' => '{view} {update} {delete}',
                'buttons'=>[
                    'update'=>function($url, $model){
                        return Html::a('<span class="fa fa-edit"></span> '.Yii::t('chanpan', 'Edit'), 
                                    yii\helpers\Url::to(['/clinical-data-management/update/'.$model->id]), [
                                    'title' => Yii::t('chanpan', 'Edit'),
                                    'class' => 'btn btn-primary btn-xs',
                                    'data-action'=>'update',
                                    'data-pjax'=>0
                        ]);
                    },
                    'delete' => function ($url, $model) {  
                        if(\Yii::$app->user->can('admin')){                        
                        return Html::a('<span class="fa fa-trash"></span> '.Yii::t('chanpan', 'Delete'), 
                                yii\helpers\Url::to(['/clinical-data-management/delete/'.$model->id]), [
                                'title' => Yii::t('chanpan', 'Delete'),
                                'class' => 'btn btn-danger btn-xs',
                                'data-confirm' => Yii::t('chanpan', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-action' => 'delete',
                                'data-pjax'=>0
                        ]);
                        }else{
                                    return '';
                                }
                            
                        
                    },
                ]
	    ],
        ],
    ]); ?>
    <?php  Pjax::end();?>

</div>
</div>
<?=  ModalForm::widget([
    'id' => 'modal-clinicaldata',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#modal-addbtn-clinicaldata').on('click', function() {
    modalClinicaldatum($(this).attr('data-url'));
});

$('#modal-delbtn-clinicaldata').on('click', function() {
    selectionClinicaldatumGrid($(this).attr('data-url'));
});

$('#clinicaldata-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#clinicaldata-grid').yiiGridView('getSelectedRows');
	disabledClinicaldatumBtn(key.length);
    },100);
});

$('.selectionCoreOptionIds').on('click',function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledClinicaldatumBtn(key.length);
});

$('#clinicaldata-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalClinicaldatum('<?= Url::to(['/clinical-data-management/view', 'id'=>''])?>'+id);
});	

$('#clinicaldata-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalClinicaldatum(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#clinicaldata-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }).fail(function() {
		<?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>
		console.log('server error');
	    });
	});
    }
    return false;
});

function disabledClinicaldatumBtn(num) {
    if(num>0) {
	$('#modal-delbtn-clinicaldata').attr('disabled', false);
    } else {
	$('#modal-delbtn-clinicaldata').attr('disabled', true);
    }
}

function selectionClinicaldatumGrid(url) {
    yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionClinicaldatumIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#clinicaldata-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalClinicaldatum(url) {
    $('#modal-clinicaldata .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-clinicaldata').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>