<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Shop $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="shop-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'shop_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= $form->field($model, 'shop_image')->fileInput()->label('Загрузить новый логотип') ?>
            <?php if ($model->shop_image): ?>
                <p>Текущий логотип: <strong><?= Html::encode($model->shop_image) ?></strong></p>
                <div>
                    <img src="<?= Yii::getAlias('@web') . '/uploads/' . Html::encode($model->shop_image) ?>" alt="Текущий логотип" style="max-width: 100px; max-height: 100px; border-radius: 10px">
                </div>
            <?php else: ?>
                <p>Логотип не установлен.</p>
            <?php endif; ?>
        </div>
        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'is_active')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
