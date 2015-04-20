<?php

namespace backend\models;

use common\models\Order;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['id'], 'integer'],
            [['customer_name', 'addtime'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        // load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
              ->andFilterWhere(['like', 'addtime', $this->addtime]);

        return $dataProvider;
    }
}
