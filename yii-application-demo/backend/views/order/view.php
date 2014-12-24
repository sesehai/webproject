<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BackendOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Backend Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_name',
            'customer_phone',
            'customer_address',
            'customer_province',
            'customer_city',
            'customer_district',
            'car_plate_type',
            'car_plate_number',
            'car_register_time',
            'car_engine_vin',
            'car_engine_number',
            'car_mileage',
            'service_time',
            'total_price',
            'pay_type',
            'invoice_title',
            'remark',
            'addtime',
            'updatetime',
            'status',
            'maintance_type',
            'car_model_id',
            'car_model_name',
            'diy',
            'source',
            'service_car_id',
            'service_car_plate_number',
            'service_begin_time',
            'service_end_time',
            'activity',
            'service_time_day',
            'service_time_span',
            'longitude',
            'latitude',
            'product_is_sale',
        ],
    ]) ?>

</div>
