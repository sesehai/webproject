<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BackendAuthAssignment */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Backend Auth Assignment',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Backend Auth Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-auth-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
