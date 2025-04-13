<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="product-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'shop_id')->textInput() ?>

        <div class="form-group">
            <?= $form->field($model, 'image')->fileInput()->label('Загрузить новое изображение') ?>
            <?php if ($model->image): ?>
                <p>Текущее изображение: <strong><?= Html::encode($model->image) ?></strong></p>
                <div>
                    <img src="<?= Yii::getAlias('@web') . '/uploads/' . Html::encode($model->image) ?>" alt="Текущее изображение" style="max-width: 100px; max-height: 100px; border-radius: 10px">
                </div>
            <?php else: ?>
                <p>Изображение не загружено</p>
            <?php endif; ?>
        </div>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'is_active')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
