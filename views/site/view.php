<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
    body {
        background-image: url(../img/banner4.png);
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
    }

    .card {
        background-color: white;
        height: auto;
        margin: 0;
        border-radius: 30px;
        box-shadow: 0 3px 9px rgba(0, 70, 43, 0.1);
        border: none;
        padding: 15px;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="tasks d-flex align-items-start justify-content-between flex-wrap flex-row">
        <h2><?= Html::encode($shop->shop_name) ?></h2>
        <a href="<?= Url::toRoute(['site/order']); ?>" class="btn btn-success">Сделать заказ</a>
    </div>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php if (!empty($product)): ?>
            <?php foreach ($product as $item): ?>
                <div class="col">
                    <div class="card">
                        <img src="/uploads/<?= $item->image; ?>" alt="Изображение товара" style="width: 100%; height: 360px; border-radius: 20px">
                        <p><?= $item->title; ?></p>
                        <p><?= $item->description; ?></p>
                        <p><?= $item->price; ?> ₽</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <div class="d-flex align-items-center justify-content-center">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'options' => [
                'class' => 'pagination',
            ],
            'linkOptions' => [
                'class' => 'page-link',
            ],
            'prevPageLabel' => '',
            'nextPageLabel' => '',
            'nextPageCssClass' => '',
        ]) ?>
    </div>
</div>