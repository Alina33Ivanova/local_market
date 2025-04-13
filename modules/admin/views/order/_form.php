<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="order-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'shop_id')->textInput() ?>

        <?= $form->field($model, 'product_id')->textInput() ?>

        <?= $form->field($model, 'take')->textInput() ?>

        <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'settlement')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'house')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'flat')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pay')->textInput() ?>

        <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cvv')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
