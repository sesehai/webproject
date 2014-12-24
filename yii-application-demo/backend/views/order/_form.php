<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BackendOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backend-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'customer_phone')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'customer_address')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'customer_province')->textInput() ?>

    <?= $form->field($model, 'customer_city')->textInput() ?>

    <?= $form->field($model, 'customer_district')->textInput() ?>

    <?= $form->field($model, 'car_plate_type')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'car_plate_number')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'car_register_time')->textInput() ?>

    <?= $form->field($model, 'car_engine_vin')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'car_engine_number')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'car_mileage')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'service_time')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'total_price')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'pay_type')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'invoice_title')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => 800]) ?>

    <?= $form->field($model, 'addtime')->textInput() ?>

    <?= $form->field($model, 'updatetime')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'maintance_type')->textInput() ?>

    <?= $form->field($model, 'car_model_id')->textInput() ?>

    <?= $form->field($model, 'car_model_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'diy')->textInput() ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'service_car_id')->textInput() ?>

    <?= $form->field($model, 'service_car_plate_number')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'service_begin_time')->textInput() ?>

    <?= $form->field($model, 'service_end_time')->textInput() ?>

    <?= $form->field($model, 'activity')->textInput(['maxlength' => 1024]) ?>

    <?= $form->field($model, 'service_time_day')->textInput() ?>

    <?= $form->field($model, 'service_time_span')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'product_is_sale')->textInput(['maxlength' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
