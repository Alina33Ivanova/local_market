<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

$this->title = 'Редактирование магазина';
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'keywords', 'content' => 'Редактирование магазина']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Редактировать, магазин, описание, название']);
?>

<style>
    body {
        background-image: url('../img/banner2.png');
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        margin: 0;
    }

    .card {
        margin: 0;
        width: 100%;
        height: auto;
        padding: 30px;
        backdrop-filter: blur(20px);
        border: none;
        background-color: white;
        border-radius: 30px;
        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container" style="position: fixed; top: 10px; right: 10px; width: 300px;">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" style="font-size: 12px;">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
</div>

<div class="site-login mt-5">
    <div class="container mb-5 border-1">
        <div class="card">
            <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
            <div class="card-body">
                <div class="row">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'inputOptions' => ['class' => 'col-lg-3 form-control'],
                            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                        ],
                    ]); ?>

                    <?= $form->field($shop, 'shop_name')->textInput(['placeholder' => 'Название магазина'])->label(false) ?>
                    <?= $form->field($shop, 'description')->textInput(['placeholder' => 'Описание магазина'])->label(false) ?>
                    <?= $form->field($shop, 'location')->textInput(['placeholder' => 'Локация магазина'])->label(false) ?>

                    <div class="form-group">
                        <?= $form->field($shop, 'shop_image')->fileInput()->label('Загрузить новый логотип') ?>
                        <?php if ($shop->shop_image): ?>
                            <p>Текущий логотип: <strong><?= Html::encode($shop->shop_image) ?></strong></p>
                            <div>
                                <img src="<?= Yii::getAlias('@web') . '/uploads/' . Html::encode($shop->shop_image) ?>" alt="Текущий логотип" style="max-width: 100px; max-height: 100px; border-radius: 10px">
                            </div>
                        <?php else: ?>
                            <p>Логотип не установлен</p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>