<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BackendAuthItem */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Backend Auth Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Backend Auth Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
