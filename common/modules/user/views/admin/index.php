 <?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
use Yii;

 
$this->title = Yii::t('chanpan', 'Member Management System');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="sdbox-header">
            <h3><i class="fa fa-users"></i> <?=  Html::encode($this->title) ?></h3><hr />
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'user-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'user-grid',
	//'panelBtn' => Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['/user/admin/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-user', 'disabled'=>true]),
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	   
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],
            [
                'format'=>'email',
                'attribute' => 'email',
                'label' => Yii::t('chanpan', 'Email'),
                'value' => 'email',

            ],
            [
                'attribute' => 'username',
                'value' => 'username',
                'headerOptions'=>['style'=>'width:10px']
            ],
            [
                'attribute' => 'firstname',
                'label' => Yii::t('chanpan', 'First name'),
                'value' => 'profile.firstname',

            ],
            [
                'attribute' => 'lastname',
                'label' => Yii::t('chanpan', 'Last name'),
                'value' => 'profile.lastname',

            ], 
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    if (extension_loaded('intl')) {
                        return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
                    } else {
                        return date('Y-m-d G:i:s', $model->created_at);
                    }
                },

            ],

	    [
		'class' => 'appxq\sdii\widgets\ActionColumn',
		'contentOptions' => ['style'=>'width:80px;text-align: center;'],
		'template' => '{update} {delete}',
                'buttons'=>[
                    'update'=>function($url, $model){
                        return Html::a('<span class="fa fa-edit"></span> '.Yii::t('chanpan', 'Edit'), 
                                    yii\helpers\Url::to(['/user/admin/update-profile/', 'id'=>$model->id]), [
                                    'title' => Yii::t('chanpan', 'Edit'),
                                    'class' => 'btn btn-warning btn-xs',
                                    'data-action'=>'update',
                                    'data-pjax'=>0
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        if($model->id != \Yii::$app->user->getId()){
                            return Html::a('<span class="fa fa-trash"></span> '.Yii::t('chanpan', 'Delete'), 
                                    yii\helpers\Url::to(['/user/admin/delete/','id'=>$model->id]), [
                                    'title' => Yii::t('chanpan', 'Delete'),
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-confirm' => Yii::t('chanpan', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                    'data-action' => 'delete',
                                    'data-pjax'=>0
                            ]);
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
    'id' => 'modal-user',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#user-grid-pjax').on('click', '#modal-addbtn-user', function() {
    modalUser($(this).attr('data-url'));
});

$('#user-grid-pjax').on('click', '#modal-delbtn-user', function() {
    selectionUserGrid($(this).attr('data-url'));
});

$('#user-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#user-grid').yiiGridView('getSelectedRows');
	disabledUserBtn(key.length);
    },100);
});

$('#user-grid-pjax').on('click', '.selectionUserIds', function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledUserBtn(key.length);
});

$('#user-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalUser('<?= Url::to(['/user/admin/update-profile/', 'id'=>''])?>'+id);
});	

$('#user-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalUser(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#user-grid-pjax'});
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

function disabledUserBtn(num) {
    if(num>0) {
	$('#modal-delbtn-user').attr('disabled', false);
    } else {
	$('#modal-delbtn-user').attr('disabled', true);
    }
}

function selectionUserGrid(url) {
    yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionUserIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#user-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalUser(url) {
    $('#modal-user .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-user').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>