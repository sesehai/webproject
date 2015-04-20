<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BackendAuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backend-auth-item-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',  
        'options' => ['class' => 'form-horizontal'],  
        'fieldConfig' => [  
            'template' => '<div class="col-sm-1">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-2">{hint}{error}</div>',  
            'labelOptions' => ['class' => 'control-label'],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'help-block'],
            'hintOptions' => ['class' => 'hint-block'],
        ],
    ]); 
    $options = ['template' => ''];
    ?>

    <?= $form->field($model, 'name', ['labelOptions' => ['label' => Yii::t('app', 'Name')]])->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'type', ['labelOptions' => ['label' => Yii::t('app', 'Type')]])->textInput() ?>

    <?= $form->field($model, 'description', ['labelOptions' => ['label' => Yii::t('app', 'Description')]])->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rule_name', ['labelOptions' => ['label' => Yii::t('app', 'Rule Name')]])->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'data', ['labelOptions' => ['label' => Yii::t('app', 'Data')]])->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at', ['labelOptions' => ['label' => Yii::t('app', 'Created At')]])->textInput() ?>

    <?= $form->field($model, 'updated_at', ['labelOptions' => ['label' => Yii::t('app', 'Updated At')]])->textInput() ?>

    <?= $form->field($model, 'updated_at')->widget(
        DatePicker::className(), [
        'inline' => FALSE,
        'language' => 'zh-CN',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
