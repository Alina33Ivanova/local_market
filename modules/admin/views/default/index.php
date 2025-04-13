<?php

use yii\helpers\Html;

$this->title = 'Административная панель';
?>

<style>
    .alert {
        background-color: white;
        height: auto;
        border-radius: 25px;
        box-shadow: 0 3px 9px rgba(0, 70, 43, 0.1);
        border: none;
        padding: 15px;
        margin-bottom: 10px;
    }
</style>

<div class="container mt-5">
    <div class="alert alert-light align-items-center d-flex justify-content-between" role="alert">
        <p>Пользователи</p>
        <li class="list-group-item"><?= Html::a('<img src="/img/arrow2.png" style="width: 30px; height: 30px" alt="Стрелка">', ['/admin/user/index'], ['data' => ['method' => 'post']]); ?></li>
    </div>
    <div class="alert alert-light d-flex align-items-center justify-content-between" role="alert">
        <p>Магазины</p>
        <li class="list-group-item"><?= Html::a('<img src="/img/arrow2.png" style="width: 30px; height: 30px" alt="Стрелка">', ['/admin/shop/index'], ['data' => ['method' => 'post']]); ?></li>
    </div>
    <div class="alert alert-light d-flex align-items-center justify-content-between" role="alert">
        <p>Продукты</p>
        <li class="list-group-item"><?= Html::a('<img src="/img/arrow2.png" style="width: 30px; height: 30px" alt="Стрелка">', ['/admin/product/index'], ['data' => ['method' => 'post']]); ?></li>
    </div>
    <div class="alert alert-light d-flex align-items-center justify-content-between" role="alert">
        <p>Заявки</p>
        <li class="list-group-item"><?= Html::a('<img src="/img/arrow2.png" style="width: 30px; height: 30px" alt="Стрелка">', ['/admin/application/index'], ['data' => ['method' => 'post']]); ?></li>
    </div>
    <div class="alert alert-light d-flex align-items-center justify-content-between" role="alert">
        <p>Заказы</p>
        <li class="list-group-item"><?= Html::a('<img src="/img/arrow2.png" style="width: 30px; height: 30px" alt="Стрелка">', ['/admin/order/index'], ['data' => ['method' => 'post']]); ?></li>
    </div>
    <div class="alert alert-light d-flex align-items-center justify-content-between" role="alert">
        <p>Отзывы</p>
        <li class="list-group-item"><?= Html::a('<img src="/img/arrow2.png" style="width: 30px; height: 30px" alt="Стрелка">', ['/admin/feedback/index'], ['data' => ['method' => 'post']]); ?></li>
    </div>
</div>