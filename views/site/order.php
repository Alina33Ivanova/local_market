<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use app\models\Product;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Сделать заказ';
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'keywords', 'content' => 'Сделать заказ']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Заказ, оформить заказ']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
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
</head>
<body>
<?php $this->beginBody() ?>

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

                    <?= $form->field($model, 'first_name')->textInput(['autofocus' => true, 'placeholder' => 'Имя'])->label(false) ?>
                    <?= $form->field($model, 'last_name')->textInput(['autofocus' => true, 'placeholder' => 'Фамилия'])->label(false) ?>

                    <?= $form->field($model, 'phone_number')->widget(\yii\widgets\MaskedInput::class, [
                        'mask' => '+7 (999)-999-99-99',
                    ])->label(false) ?>

                    <?= $form->field($model, 'product_id')->dropDownList($product, ['prompt' => 'Выберите товар'])->label('Товар')->label(false) ?>

                    <?= $form->field($model, 'take')->checkbox()->label('Самовывоз') ?>


                    <?= $form->field($model, 'delivery_address')->checkbox(['id' => 'delivery-checkbox'])->label('Доставка на дом') ?>
                    <div id="delivery-fields" style="display: none;">
                        <?= $form->field($model, 'street')->textInput(['placeholder' => 'Улица'])->label(false) ?>
                        <?= $form->field($model, 'settlement')->textarea(['placeholder' => 'Поселение'])->label(false) ?>
                        <?= $form->field($model, 'house')->textarea(['placeholder' => 'Дом/Строение'])->label(false) ?>
                        <?= $form->field($model, 'flat')->textarea(['placeholder' => 'Квартира'])->label(false) ?>
                    </div>

                    <?= $form->field($model, 'pay')->checkbox()->label('Оплата при получении') ?>

                    <?= $form->field($model, 'payment')->checkbox(['id' => 'payment-checkbox'])->label('Оплата картой') ?>
                    <div id="payment-fields" style="display: none;">
                        <?= $form->field($model, 'card_number')->textInput(['placeholder' => 'Номер карты'])->label(false) ?>
                        <?= $form->field($model, 'cvv')->textInput(['placeholder' => 'CVV'])->label(false) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success', 'name' => 'login-button', 'style' => 'width: auto']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
// Обработка изменения состояния чекбокса для доставки
$('#delivery-checkbox').change(function() {
    if ($(this).is(':checked')) {
        $('#take').prop('checked', false); // Снимаем выбор с самовывоза
        $('#delivery-fields').show(); // Показываем поля доставки
    } else {
        $('#delivery-fields').hide(); // Скрываем поля доставки
    }
});

// Обработка изменения состояния чекбокса для самовывоза
$('#take').change(function() {
    if ($(this).is(':checked')) {
        $('#delivery-checkbox').prop('checked', false); // Снимаем выбор с доставки
        $('#delivery-fields').hide(); // Скрываем поля доставки
    }
});

// Обработка изменения состояния чекбокса для оплаты картой
$('#payment-checkbox').change(function() {
    if ($(this).is(':checked')) {
        $('#pay').prop('checked', false); // Снимаем выбор с оплаты при получении
        $('#payment-fields').show(); // Показываем поля для оплаты картой
    } else {
        $('#payment-fields').hide(); // Скрываем поля для оплаты картой
    }
});

// Обработка изменения состояния чекбокса для оплаты при получении
$('#pay').change(function() {
    if ($(this).is(':checked')) {
        $('#payment-checkbox').prop('checked', false); // Снимаем выбор с оплаты картой
        $('#payment-fields').hide(); // Скрываем поля для оплаты картой
    }
});
JS;

$this->registerJs($script);
?>
