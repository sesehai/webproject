<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Backend Auth Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-auth-item-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('app', 'Backend Auth Item'),
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'attribute' => 'name',
                'format' => 'text',
                'label' => Yii::t('app', 'Name'),
            ],
            [
                'attribute' => 'type',
                'format' => 'text',
                'label' => Yii::t('app', 'Type'),
            ],
            [
                'attribute' => 'description',
                'format' => 'text',
                'label' => Yii::t('app', 'Description'),
            ],
            [
                'attribute' => 'rule_name',
                'format' => 'text',
                'label' => Yii::t('app', 'Rule Name'),
            ],
            [
                'attribute' => 'data',
                'format' => 'text',
                'label' => Yii::t('app', 'Data'),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'text',
                'label' => Yii::t('app', 'Created At'),
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'text',
                'label' => Yii::t('app', 'Updated At'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' => ['view','delete','update'],
            ],
        ],
    ]) ?>

</div>
