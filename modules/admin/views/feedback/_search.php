<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FeedbackSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="feedback-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'user_id') ?>

        <?= $form->field($model, 'feedback_text') ?>

        <?= $form->field($model, 'mark') ?>

<!--        --><?//= $form->field($model, 'created_at') ?>
<!---->
<!--        --><?php // echo $form->field($model, 'updated_at') ?>

        <?php  echo $form->field($model, 'is_active') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Поиск'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Сбросить'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
