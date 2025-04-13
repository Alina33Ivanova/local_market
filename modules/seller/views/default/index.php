<?php
/** @var yii\web\View $this */

/** @var app\models\Shop[] $shops */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Личный кабинет';

?>

<div class="container" style="position: fixed; top: 10px; right: 10px; width: 300px;">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" style="font-size: 12px;">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
</div>

<div class="container">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Мои данные
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                 style="padding: 15px">
                <?php if (Yii::$app->user->identity): ?>
                    <?php $user = Yii::$app->user->identity; ?>
                    <div class="profile-info col-md-9">
                        <div class="panel">
                            <div class="bio-graph">
                                <p><span>Фамилия: </span> &nbsp; <?= $user->last_name ?></p>
                                <p><span>Имя: </span> &nbsp; <?= $user->first_name ?></p>
                                <p><span>Отчество: </span> &nbsp; <?= $user->patronymic ?></p>
                                <p><span>Электронная почта: </span> &nbsp; <?= $user->email ?></p>
                                <p><span>Номер телефона: </span> &nbsp; <?= $user->phone_number ?></p>
                                <p><span>Логин: </span> &nbsp; <?= $user->username ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="title d-flex align-items-center justify-content-center flex-wrap flex-row mt-5 mb-3">
    <h2 style="margin-right: 10px">Мои магазины</h2>
    <?= Html::a('<img src="/img/plus.png" style="width: 20px; height: 20px" alt="Иконка добавить">', ['/site/shopcreate'], ['class' => 'round-button']); ?>
</div>
<div class="shops">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4 shop-cards">
            <?php foreach ($shop as $item): ?>
                <div class="col">
                    <div class="card d-flex align-items-center justify-content-start flex-wrap flex-row mt-5 mb-5">
                        <img src="/uploads/<?= $item->shop_image ?>" class="card-img-top" alt="Логотип магазина"
                             style="width: 50px; height: 50px; margin-right: 10px; margin-left: 10px; border-radius: 15px">
                        <p class="card-title">Название: <?= Html::encode($item->shop_name) ?></p>
                        <div class="card-body">
                            <p class="card-title">Описание: <?= Html::encode($item->description) ?></p>
                            <p class="card-title">Местоположение: <?= Html::encode($item->location) ?></p>
                            <?= Html::a('<img src="/img/update.png" style="width: 20px; height: 20px" alt="Иконка редактировать">', ['/site/updateshop', 'id' => $item->id], ['style' => 'margin-right: 10px', 'class' => 'round-button', 'data' => ['method' => 'post']]); ?>
                            <?= Html::a('<img src="/img/delete.png" style="width: 20px; height: 20px" alt="Иконка удалить">', ['/site/deleteshop', 'id' => $item->id], ['class' => 'round-button', 'data' => ['confirm' => 'Удалить магазин?', 'method' => 'post']]); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="title d-flex align-items-center justify-content-center flex-wrap flex-row mt-5 mb-3">
    <h2 style="margin-right: 10px">Мои товары</h2>
    <?= Html::a('<img src="/img/plus.png" style="width: 20px; height: 20px" alt="Иконка добавить">', ['/site/productcreate'], ['class' => 'round-button']); ?>
</div>
<div class="products">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4 product-cards">
            <?php foreach ($products as $index => $product): ?>
                <div class="col">
                    <div class="card d-flex align-items-center justify-content-start flex-wrap flex-row mt-5 mb-5">
                        <img src="/uploads/<?= $product->image ?>" class="card-img-top" alt="Изображение товара"
                             style="width: 100%; height: 360px; border-radius: 20px;">
                        <p class="card-title" style="padding: 15px">Название: <?= Html::encode($product->title) ?></p>
                        <div class="card-body">
                            <?php
                            $description = Html::encode($product->description);
                            $words = explode(' ', $description);
                            $visibleWords = array_slice($words, 0, 6);
                            $shortDescription = implode(' ', $visibleWords);
                            $hasMoreWords = count($words) > 7;
                            ?>
                            <p class="card-title short-description">Описание: <?= $shortDescription ?><?php if ($hasMoreWords): ?>...
                                <a href="#" class="read-more" data-index="<?= $index ?>">Далее</a><?php endif; ?></p>

                            <div class="full-description" style="display: none;">
                                <p><?= $description ?></p>
                                <button class="hide-description" style="background-color: white; text-decoration: linen">х</button>
                            </div>

                            <p class="card-title">Цена: <?= Html::encode($product->price) ?> ₽</p>
                            <p class="card-title">Магазин: <?= Html::encode($product->shop->shop_name) ?></p>
                            <?= Html::a('<img src="/img/update.png" style="width: 20px; height: 20px" alt="Иконка редактировать">', ['/site/updateproduct', 'id' => $product->id], ['style' => 'margin-right: 10px', 'class' => 'round-button', 'data' => ['method' => 'post']]); ?>
                            <?= Html::a('<img src="/img/delete.png" style="width: 20px; height: 20px" alt="Иконка удалить">', ['/site/deleteproduct', 'id' => $product->id], ['class' => 'round-button', 'data' => ['confirm' => 'Удалить продукт?', 'method' => 'post']]); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.read-more').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const index = this.getAttribute('data-index');
                const fullDescription = document.querySelectorAll('.full-description')[index];
                fullDescription.style.display = 'block';
                this.style.display = 'none';
            });
        });

        document.querySelectorAll('.hide-description').forEach(function (button) {
            button.addEventListener('click', function () {
                const fullDescription = this.closest('.full-description');
                fullDescription.style.display = 'none';
                const readMoreButton = fullDescription.previousElementSibling.querySelector('.read-more');
                readMoreButton.style.display = 'inline';
            });
        });
    });
</script>

<h2 class="mt-5 mb-3" style="text-align: center; margin-top: 20px">Сообщения от покупателей</h2>
<div class="messages-buy mb-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="col">
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <p><?= htmlspecialchars(($msg->user->first_name ?? '') . ' ' . ($msg->user->last_name ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="card-text"><?= Html::encode($msg->text) ?></p>
                                <a href="#" class="reply-button" data-sender-id="<?= $msg->user_id ?>"
                                   onclick="showReplyForm(this)">Ответить</a>
                                <div class="reply-form" style="display:none; margin-top: 10px;">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <?= $form->field($model, 'sender_id')->hiddenInput(['value' => $msg->user_id])->label(false) ?>
                                    <?= $form->field($model, 'text')->textarea()->label('Ваш ответ') ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('Отправить <img src="/img/send.png" width="10px" height="10px" alt="Иконка отправить сообщение">', ['class' => 'btn btn-success', 'style' => 'width: auto;']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p style="margin-top: 50px">У вас нет сообщений</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function showReplyForm(button) {
        var replyForm = $(button).closest('.card-body').find('.reply-form').eq(0);
        replyForm.toggle();
    }
</script>




