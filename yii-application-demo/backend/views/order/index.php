<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Order Manage');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-order-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-condensed table-bordered'],
        'dataProvider' => $dataProvider,
        'filterModel' => $backendOrder,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            'customer_name',
            'customer_phone',
            'customer_address',
            'customer_province',
            // 'customer_city',
            // 'customer_district',
            // 'car_plate_type',
            // 'car_plate_number',
            // 'car_register_time',
            // 'car_engine_vin',
            // 'car_engine_number',
            // 'car_mileage',
            // 'service_time',
            // 'total_price',
            // 'pay_type',
            // 'invoice_title',
            // 'remark',
            [
                'attribute' => 'addtime',
                'format' => ['date', 'php:Y-m-d']
            ],
            // 'updatetime',
            // 'status',
            // 'maintance_type',
            // 'car_model_id',
            // 'car_model_name',
            // 'diy',
            // 'source',
            // 'service_car_id',
            // 'service_car_plate_number',
            // 'service_begin_time',
            // 'service_end_time',
            // 'activity',
            // 'service_time_day',
            // 'service_time_span',
            // 'longitude',
            // 'latitude',
            // 'product_is_sale',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' => ['view','delete','update'],
            ],
        ],
    ]); ?>

</div>
