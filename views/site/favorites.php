<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $shops app\models\Shop[] */

$this->title = 'Избранное';
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
        border-radius: 25px;
        box-shadow: 0 3px 9px rgba(0, 70, 43, 0.1);
        border: none;
        padding: 15px;
    }
</style>

<div class="container mt-5 border-1">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php if (empty($shops)): ?>
        <div class="asd">
            <p>Нет избранных магазинов</p>
        </div>
    <?php else: ?>
    <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($shops as $item): ?>
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
                            <?= Html::a('<img src="../img/delete.png" style="width: 20px; height: 20px">', ['site/remove-from-favorites', 'id' => $item->id], ['class' => 'round-button', 'data-method' => 'post']) ?>
                        </div>
                        <p class

                        <p class="card-title"><?= htmlspecialchars($item->description ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                        <div style="margin-top: auto;">
                            <div class="d-flex align-items-center justify-content-between flex-wrap flex-row"
                                 style="margin-top: 20px">
                                <p class="card-title">
                                    <img src="../img/location.png" style="width: 25px; height: 25px"
                                         alt="Иконка местоположение"><?= htmlspecialchars($item->location ?? '', ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <?= Html::a('<img src="../img/arrow.png" style="width: 20px; height: 20px" alt="Стрелка">', ['site/view', 'id' => $item->id], ['class' => 'round-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
