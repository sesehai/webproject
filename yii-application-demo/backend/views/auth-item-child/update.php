<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BackendAuthItemChild */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Backend Auth Item Child',
]) . ' ' . $model->parent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Backend Auth Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="backend-auth-item-child-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
