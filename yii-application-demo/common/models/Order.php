<?php

namespace common\models;

use Yii;
use base\BaseActiveRecord;

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
class Order extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_province', 'customer_city', 'customer_district', 'status', 'maintance_type', 'car_model_id', 'diy', 'service_car_id'], 'integer'],
            [['car_register_time', 'addtime', 'updatetime', 'service_begin_time', 'service_end_time', 'service_time_day'], 'safe'],
            [['car_mileage', 'total_price'], 'number'],
            [['customer_name', 'customer_phone', 'service_time'], 'string', 'max' => 200],
            [['customer_address', 'invoice_title'], 'string', 'max' => 500],
            [['car_plate_type', 'car_plate_number', 'car_engine_vin', 'car_engine_number', 'car_model_name', 'service_car_plate_number', 'longitude', 'latitude'], 'string', 'max' => 100],
            [['pay_type', 'product_is_sale'], 'string', 'max' => 1],
            [['remark'], 'string', 'max' => 800],
            [['source'], 'string', 'max' => 64],
            [['activity'], 'string', 'max' => 1024],
            [['service_time_span'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_name' => '客户姓名',
            'customer_phone' => '客户电话',
            'customer_address' => '地址',
            'customer_province' => '省',
            'customer_city' => 'Customer City',
            'customer_district' => 'Customer District',
            'car_plate_type' => 'Car Plate Type',
            'car_plate_number' => 'Car Plate Number',
            'car_register_time' => 'Car Register Time',
            'car_engine_vin' => 'Car Engine Vin',
            'car_engine_number' => 'Car Engine Number',
            'car_mileage' => 'Car Mileage',
            'service_time' => 'Service Time',
            'total_price' => 'Total Price',
            'pay_type' => 'Pay Type',
            'invoice_title' => 'Invoice Title',
            'remark' => 'Remark',
            'addtime' => '添加时间',
            'updatetime' => 'Updatetime',
            'status' => 'Status',
            'maintance_type' => 'Maintance Type',
            'car_model_id' => 'Car Model ID',
            'car_model_name' => 'Car Model Name',
            'diy' => 'Diy',
            'source' => 'Source',
            'service_car_id' => 'Service Car ID',
            'service_car_plate_number' => 'Service Car Plate Number',
            'service_begin_time' => 'Service Begin Time',
            'service_end_time' => 'Service End Time',
            'activity' => 'Activity',
            'service_time_day' => 'Service Time Day',
            'service_time_span' => 'Service Time Span',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'product_is_sale' => 'Product Is Sale',
        ];
    }
}
