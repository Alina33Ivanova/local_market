<?php

/* @var $this yii\web\View */
/* @var $shop app\models\Shop[] */
/* @var $query string */

$this->title = 'Каталог магазинов';
$this->params['breadcrumbs'][] = $this->title;

use app\models\ShopSearch;
use yii\bootstrap5\Html;
use yii\widgets\LinkPager;

$model = new ShopSearch();

$this->registerMetaTag(['name' => 'keywords', 'content' => 'Каталог, магазин, каталог магазинов']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Магазин, местоположение, подарок, каталог']);

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
        border-radius: 25px;
        box-shadow: 0 3px 9px rgba(0, 70, 43, 0.1);
        border: none;
        padding: 15px;
    }
</style>

<div class="banner-catalog mt-5" style="margin-bottom: 20px">
    <div class="container d-flex justify-content-between flex-wrap flex-row mt-2">
        <div class="d-flex flex-wrap flex-row align-items-start flex-wrap flex-column">
            <h2>Каталог магазинов</h2>
            <p>Найдите что-то особенное для себя или в подарок!</p>
        </div>
        <div class="search d-flex align-items-center justify-content-center flex-wrap flex-row">
            <form method="get" action="<?= yii\helpers\Url::to(['site/catalog']) ?>" class="form-input mb-4">
                <input type="text" name="query" value="<?= htmlspecialchars($query ?? '', ENT_QUOTES, 'UTF-8') ?>"
                       placeholder="Введите местоположение"/>
                <button type="submit"><img src="../img/magnifier.png" alt="Иконка поиск"
                                           style="width: 30px; height: 30px"></button>
            </form>
        </div>
    </div>
</div>

<div class="container mb-5 border-1">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php foreach ($shop as $item): ?>
            <div class="col">
                <div class="card"
                     style="height: auto; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="shop_description d-flex align-items-center justify-content-between flex-wrap flex-row"
                         style="margin-bottom: 20px">
                        <div class="d-flex align-items-center flex-wrap flex-row">
                            <img src="/uploads/<?= htmlspecialchars($item->shop_image ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                 class="card-img-top" alt="Логотип магазина"
                                 style="width: 50px; height: 50px; margin-right: 10px; border-radius: 15px">
                            <p class="card-title"><?= htmlspecialchars($item->shop_name ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <?= Html::a('<img src="../img/heart.png" style="width: 20px; height: 20px;" alt="Избранное">', ['site/add-to-favorites', 'id' => $item->id], ['class' => 'round-button']) ?>
                    </div>
                    <p class="card-title"><?= htmlspecialchars($item->description ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-row" style="margin-top: 20px">
                        <p class="card-title">
                            <img src="../img/location.png" style="width: 25px; height: 25px" alt="Иконка местоположение"><?= htmlspecialchars($item->location ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <?= Html::a('<img src="../img/arrow.png" style="width: 20px; height: 20px" alt="Стрелка">', ['site/view', 'id' => $item->id], ['class' => 'round-button']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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