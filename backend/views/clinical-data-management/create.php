<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Clinicaldata */

$this->title = Yii::t('app', 'Create Clinicaldata');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clinicaldatas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinicaldata-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
