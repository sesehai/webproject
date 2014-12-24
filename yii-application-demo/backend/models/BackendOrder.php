<?php

namespace backend\models;

use common\models\Order;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $customer_address
 * @property integer $customer_province
 * @property integer $customer_city
 * @property integer $customer_district
 * @property string $car_plate_type
 * @property string $car_plate_number
 * @property string $car_register_time
 * @property string $car_engine_vin
 * @property string $car_engine_number
 * @property string $car_mileage
 * @property string $service_time
 * @property string $total_price
 * @property string $pay_type
 * @property string $invoice_title
 * @property string $remark
 * @property string $addtime
 * @property string $updatetime
 * @property integer $status
 * @property integer $maintance_type
 * @property integer $car_model_id
 * @property string $car_model_name
 * @property integer $diy
 * @property string $source
 * @property integer $service_car_id
 * @property string $service_car_plate_number
 * @property string $service_begin_time
 * @property string $service_end_time
 * @property string $activity
 * @property string $service_time_day
 * @property string $service_time_span
 * @property string $longitude
 * @property string $latitude
 * @property string $product_is_sale
 */
class BackendOrder extends Order
{
}
