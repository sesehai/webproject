<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BackendAuthRule */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Backend Auth Rule',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Backend Auth Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="backend-auth-rule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
