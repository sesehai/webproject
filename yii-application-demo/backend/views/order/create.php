<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BackendOrder */

$this->title = 'Create Backend Order';
$this->params['breadcrumbs'][] = ['label' => 'Backend Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
