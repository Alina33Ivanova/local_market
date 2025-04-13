<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Feedback $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="feedback-form">

        <?php $form = ActiveForm::begin(); ?>

<!--        --><?//= $form->field($model, 'user_id')->textInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'feedback_text')->textInput(['maxlength' => true]) ?>
<!---->
<!--        --><?//= $form->field($model, 'mark')->textInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'is_active')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
