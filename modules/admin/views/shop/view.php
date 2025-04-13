<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Shop $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Магазины'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container">
    <div class="shop-view">

        <h3><?= Html::encode($this->title) ?></h3>

        <p>
            <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'style' => 'background-color: #F37886; border: none; border-radius: 20px',
                'data' => [
                    'confirm' => Yii::t('app', 'Вы хотите удалить магазин?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'user_id',
                'shop_name',
                'description:ntext',
                'shop_image',
                'location',
                'created_at',
                'updated_at',
                'is_active',
            ],
        ]) ?>

    </div>
</div>
