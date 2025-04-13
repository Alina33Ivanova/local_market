<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="order-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'first_name') ?>

        <?= $form->field($model, 'last_name') ?>

        <?= $form->field($model, 'phone_number') ?>

        <?= $form->field($model, 'shop_id') ?>

        <?php  echo $form->field($model, 'product_id') ?>

        <?php  echo $form->field($model, 'take') ?>

        <?php  echo $form->field($model, 'delivery_address') ?>

        <?php  echo $form->field($model, 'street') ?>

        <?php  echo $form->field($model, 'settlement') ?>

        <?php  echo $form->field($model, 'house') ?>

        <?php  echo $form->field($model, 'flat') ?>

        <?php  echo $form->field($model, 'pay') ?>

        <?php  echo $form->field($model, 'payment') ?>

        <?php  echo $form->field($model, 'card_number') ?>

        <?php  echo $form->field($model, 'cvv') ?>

        <?php  echo $form->field($model, 'created_at') ?>

        <?php  echo $form->field($model, 'updated_at') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Поиск'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Сброс'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
