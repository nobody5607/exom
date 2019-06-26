<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinicaldata */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Clinicaldata',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clinicaldatas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinicaldata-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
