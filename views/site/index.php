<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Главная';

$this->registerMetaTag(['name' => 'keywords', 'content' => 'Главная, LocalMarket']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Создавай, продавай, покупай, о нашем сайте, карьера, развитие, доставка, продавец, отзывы']);
?>

<style>
    .card {
        background-color: white;
        height: auto;
        margin: 0;
        border-radius: 25px;
        box-shadow: 0 3px 9px rgba(0, 70, 43, 0.1);
        border: none;
        padding: 15px;
    }
</style>


<div class="container" style="position: fixed; top: 10px; right: 10px; width: 300px;">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" style="font-size: 12px;">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
</div>

<div class="first_screen d-flex flex-column flex-md-column align-items-center justify-content-center">
    <h1 style="text-align: center">Local Market</h1>
    <h4 style="text-align: center">создавай, продавай, покупай</h4>
    <a href="<?= Url::toRoute(['site/catalog']); ?>" class="btn btn-success">Перейти к каталогу</a>
</div>

<div class="container mt-5">
    <div class="second_screen d-flex justify-content-around flex-wrap flex-column">
        <h2 style="text-align: center">О нашем сайте</h2>
    </div>
    <div class="d-flex align-items-center justify-content-around flex-wrap flex-row mt-2">
        <div class="d-flex align-items-center flex-column flex-wrap mb-3" id="text">
            <img src="/img/career.png" width="50px" height="50px" alt="Иконка карьера и развитие">
            <h4>Развитие и карьера</h4>
            <?= Html::tag('p', 'Мы предоставляем возможности<br>для развития вашего бизнеса', ['class' => 'text-center']) ?>
        </div>
        <div class="d-flex align-items-center flex-column flex-wrap mb-3" id="text">
            <img src="/img/support.png" width="50px" height="50px" alt="Иконка техподдержка">
            <h4>Поддержка 24/7</h4>
            <?= Html::tag('p', 'Наши специалисты готовы помочь<br>вам в любое время суток', ['class' => 'text-center']) ?>
        </div>
        <div class="d-flex align-items-center flex-column flex-wrap mb-3" id="text">
            <img src="/img/shopping.png" width="50px" height="50px" alt="Иконка шоппинг">
            <h4>Шоппинг</h4>
            <?= Html::tag('p', 'На нашем портале огромный выбор товаров<br>на любой случай жизни', ['class' => 'text-center']) ?>
        </div>
        <div class="d-flex align-items-center flex-column flex-wrap mb-3" id="text">
            <img src="/img/delivery.png" width="50px" height="50px" alt="Иконка доставка">
            <h4>Доставка</h4>
            <?= Html::tag('p', 'Доставим товар<br>в любую часть города', ['class' => 'text-center']) ?>
        </div>
    </div>
</div>

<div class="instruction mt-4">
    <div class="container">
        <h2 style="text-align: center">Как стать продавцом</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-2">
            <div class="col">
                <div class="card"
                     style="background: linear-gradient(to bottom, #F695A0, #F37886); color: white; height: 300px;">
                    <div class="card-body d-flex flex-wrap flex-column justify-content-center">
                        <h5 class="card-title" style="text-align: start">Оставьте заявку</h5>
                        <p class="card-text" style="text-align: start; color: white"> Заполните данные о себе и о вашем
                            будущем магазине, после чего наши специалисты свяжутся с вами</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"
                     style="background: linear-gradient(to bottom, #EDB674, #F7CA95); color: white; height: 300px">
                    <div class="card-body d-flex flex-wrap flex-column justify-content-center">
                        <h5 class="card-title" style="text-align: start">Дождитесь одобрения администратора</h5>
                        <p class="card-text" style="text-align: start; color: white">После одобрения специалиста вы
                            будете обладать правами на создания магазина</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"
                     style="background: linear-gradient(to bottom, #65D6F3, #96E7FC); color: white; height: 300px">
                    <div class="card-body d-flex flex-wrap flex-column justify-content-center">
                        <h5 class="card-title" style="text-align: start">Создайте свой магазин</h5>
                        <p class="card-text" style="text-align: start; color: white">Создайте свой собственный магазин,
                            укажите данные магазина, после чего наши специлисты опубликуют его</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"
                     style="background: linear-gradient(to bottom, #C77BF0, #CA9BE3); color: white; height: 300px">
                    <div class="card-body d-flex flex-wrap flex-column justify-content-center">
                        <h5 class="card-title" style="text-align: start">Публикуйте товары</h5>
                        <p class="card-text" style="text-align: start; color: white">Выкладывайте свои уникальные товары
                            на
                            нашем сайте. Ваши изделия найдут своего клиента!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="feedbacks mt-5">
    <div class="container">
        <div class="text d-flex justify-content-around flex-wrap flex-column">
            <h2 style="margin-top: 20px; text-align: center">Отзывы</h2>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-2">
            <?php foreach ($feedback as $item): ?>
                <div class="col">
                    <div class="card mb-5">
                        <div class="card-body">
                            <?php $mark = $item->mark;
                            $ratingResult = '<div class="rating-result" style="width: 265px; margin: 0 auto;">';
                            for ($i = 1; $i <= 5; $i++) {
                                $starClass = ($i <= $mark) ? 'active' : '';
                                $ratingResult .= '<span style="padding: 0; font-size: 25px; margin: 0 3px; line-height: 1; color: ' . (($i <= $mark) ? '#f39c12' : '#c2c2c2') . ';">★</span>';
                            }
                            $ratingResult .= '</div>';
                            echo $ratingResult; ?>

                            <?php if ($item->user): ?>
                                <p class="card-text"><?= $item->user->first_name . ' ' . $item->user->last_name ?></p>
                            <?php endif; ?>
                            <p class="card-title"><?= $item->feedback_text ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="feedback-forms d-flex align-items-center justify-content-between flex-wrap flex-row">
        <img src="../img/phone.png" class="feedback-image" alt="Фото телефон и отзывы">
        <div class="feedback-form-container d-flex align-items-start justify-content-center flex-wrap flex-column">
            <h3>Ваше мнение помогает<br>нам становиться лучше!</h3>
            <p>Мы стремимся сделать наш сайт ещё лучше,<br>и именно ваши отзывы помогают нам в этом.<br>Если вы недавно приобрели товар или воспользовались<br>услугами, пожалуйста, поделитесь своим опытом!  </p>
            <div class="form-container">
                <?php if ($isGuest): ?>
                    <p>Пожалуйста, <a href="<?= yii\helpers\Url::to(['site/login']) ?>">авторизуйтесь</a>, чтобы оставить отзыв.</p>
                <?php else: ?>
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="stars">
                        <div class="rating-area">
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5" title="Оценка «5»"></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4" title="Оценка «4»"></label>
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3" title="Оценка «3»"></label>
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2" title="Оценка «2»"></label>
                            <input type="radio" id="star-1" name="rating" value="1">
                            <label for="star-1" title="Оценка «1»"></label>
                        </div>
                        <?= $form->field($model, 'mark')->hiddenInput(['id' => 'rating-mark'])->label(false) ?>
                    </div>
                    <div class="fdbck d-flex align-items-center justify-content-center flex-wrap flex-row">
                        <?= $form->field($model, 'feedback_text')->textarea(['placeholder' => 'Отзыв', 'style' => 'height: 38px'])->label(false) ?>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', '<img src="/img/send.png" width="20px" height="20px" alt="Иконка оставить отзыв">'), ['class' => 'btn btn-success', 'style' => 'width: auto; margin-left: 10px']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.rating-area input[type="radio"]').click(function () {
            var selectedRating = $(this).val();
            $('#rating-mark').val(selectedRating);
        });
    });
</script>


