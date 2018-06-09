<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use richardfan\widget\JSRegister;

$this->title = Yii::t('chanpan', 'Member Management System');
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="panel panel-default">
    <div class="panel-body">
        <h3><i class="fa fa-users"></i> <?= Html::encode($this->title) ?></h3><hr>
        <?php Pjax::begin(['id' => 'grid-user-pjax', 'timeout' => 5000]) ?> 
        
        
        <!-- เรียก view _search.php -->
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <br>
        
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'hover' => true,
            'resizableColumns' => true,
            //'layout' => "{items}\n{pager}",
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                'email',
                'username',
                [
                    'attribute' => 'firstname',
                    'label' => Yii::t('chanpan', 'First name'),
                    'value' => 'profile.firstname'
                ],
                [
                    'attribute' => 'lastname',
                    'label' => Yii::t('chanpan', 'Last name'),
                    'value' => 'profile.lastname'
                ],
                [
                    'headerOptions' => ['style' => 'width:150px;'],
                    'label' => Yii::t('chanpan', 'Sitecode'),
                    'value' => function($model) {
                        return $model->profile->sitecode;
                    }
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
                    'attribute' => 'last_login_at',
                    'label' => Yii::t('chanpan', 'Last login'),
                    'value' => function ($model) {
                        if (!$model->last_login_at || $model->last_login_at == 0) {
                            return Yii::t('user', 'Never');
                        } else if (extension_loaded('intl')) {
                            return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->last_login_at]);
                        } else {
                            return date('Y-m-d G:i:s', $model->last_login_at);
                        }
                    },
                ],
                [
                    'headerOptions' => ['style' => 'width:150px;'],
                    'header' => Yii::t('user', 'Confirmation'),
                    'value' => function ($model) {
                        if ($model->isConfirmed) {
                            return '<div class="text-center">
                                <span class="text-success">' . Yii::t('user', 'Confirmed') . '</span>
                            </div>';
                        } else {
                            return Html::a(Yii::t('user', 'Confirm'), ['confirm', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-success btn-block',
                                        'data-method' => 'post',
                                        'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
                            ]);
                        }
                    },
                    'format' => 'raw',
                    'visible' => Yii::$app->getModule('user')->enableConfirmation,
                ],
                [
                    'headerOptions' => ['style' => 'width:150px;'],
                    'header' => Yii::t('user', 'Block status'),
                    'value' => function ($model) {
                        if ($model->isBlocked) {
                            return Html::a(Yii::t('user', 'Unblock'), ['block', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-success btn-block',
                                        'data-method' => 'post',
                                        'data-confirm' => Yii::t('user', 'Are you sure you want to unblock this user?'),
                            ]);
                        } else {
                            return Html::a(Yii::t('user', 'Block'), ['block', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-danger btn-block',
                                        'data-method' => 'post',
                                        'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?'),
                            ]);
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'header' => Yii::t('chanpan', 'Admin'),
                    'value' => function ($model) {
                        $data = \common\modules\user\classes\CNAuth::canAdmin($model->id);

                        //$sitecode = isset($model->profile->sitecode) ? $model->profile->sitecode : '';

                        if (!empty($data)) {
                            return '<i style="color:green;" class="glyphicon glyphicon-ok"></i>';
                        }
                        return '<i style="color:red;" class="glyphicon glyphicon-remove-sign"></i>';
                    },
                    'format' => 'raw',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'contentOptions' => ['style' => 'width:90px;text-align: center;'],
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'header' => Yii::t('user', ''),
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {

                            return Html::a('<span class="fa fa-edit"></span> ' . Yii::t('chanpan', 'Edit'), yii\helpers\Url::to(['/user/admin/update-profile', 'id' => $model->id]), [
                                        'title' => Yii::t('chanpan', 'Edit'),
                                        'class' => 'btn btn-warning btn-xs',
                                        'data-action' => 'update'
                            ]);
                        },
                        'delete' => function ($url, $model) {

                            if ($model->id != Yii::$app->user->getId()) {
                                return Html::a('<span class="fa fa-trash"></span> ' . Yii::t('chanpan', 'Delete'), $url, [
                                            'title' => Yii::t('chanpan', 'Delete'),
                                            'class' => 'btn btn-danger btn-xs',
                                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                            'data-method' => 'post',
                                            'data-action' => 'delete'
                                ]);
                            }
                        },
                    ],
                    'contentOptions' => ['style' => 'width:160px;text-align:left;']
                ],
            ],
        ]);
        ?>

        <?php Pjax::end() ?>
    </div>
</div>
<?php 
    echo yii\bootstrap\Modal::widget([
        'id'=>'modal-user',
        'size'=>'modal-lg',
        'options'=>['tabindex' => false]
    ]);
?>
<?php JSRegister::begin(); ?>
<script>
    $('.btn').on('click', function(){
       let action = $(this).attr('data-action');
       let url = $(this).attr('href');
       if(action === 'update'){
           modalUser(url);
       }
       return false;
    });
    function modalUser(url) {
        $('#modal-user .modal-content').html("<div class='text-center'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $('#modal-user').modal('show')
        .find('.modal-content')
        .load(url);
    }
</script>
<?php JSRegister::end();?>
