<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinicaldata */

$this->title = 'Clinicaldata#'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clinicaldatas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinicaldata-view">

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="itemModalLabel"><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="modal-body">
        <?= DetailView::widget([
	    'model' => $model,
	    'attributes' => [
		'id',
		'hn',
		'firstname',
		'lastname',
		'sex',
		'age',
		'birthdate',
		'address:ntext',
	    ],
	]) ?>
    </div>
</div>
