<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BackendAuthItemChild */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Backend Auth Item Child',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Backend Auth Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-auth-item-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
